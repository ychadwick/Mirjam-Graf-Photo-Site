<?php
define("__MG_CONFIG",'menu_items_');
class CustomMenu
{
	static public $breadCrumbNodes = array();
	static public $active = '';

	static public function getMenu($nodes = array(),$html_attrs = array(), $open = true)
	{
		$lis = array();
		$modName = sfContext::getInstance()->getModuleName();

		foreach($nodes as $node)
		{
			$parsed = self::parseMenuItem($node,$modName,$html_attrs,$open);
			if($parsed!==false)
			{
				$lis[] = $parsed ;
			}
		}


		$html_attrs['class'] = isset($html_attrs['class']) ? $html_attrs['class'] : '' ;
		$htmlattrs = array();
		foreach($html_attrs as $attribute => $value)
		{
			if(!empty($value))
			{
				$htmlattrs[] = $attribute.'="'.$value.'"';
			}
		}



		return count($lis)>0 ? content_tag('ul',implode(' ',$lis),implode(' ',$htmlattrs)) : '';
	}

	static private function getActiveChildren($app_items)
	{
		$active = false;

		foreach($app_items as $node)
		{
			$menuItem = sfConfig::get('app_'.__MG_CONFIG.$node,null);

			$node_items = isset($menuItem['items']) ? $menuItem['items'] : array();

			if(!empty($node_items))
			{
				$active = self::getActiveChildren($node_items);
			}

			if($active)
			{
				return true;
			}


			if(in_array(sfContext::getInstance()->getModuleName(), $menuItem['module']))
			{
				return true;
			}
		}

		return false;
	}

	static public function getBreadCrumb($nodes, $open)
	{
		foreach($nodes as $node)
		{
			$active = false;
			$menuItem = sfConfig::get('app_'.__MG_CONFIG.$node,null);
			$app_items = isset($menuItem['items']) ? $menuItem['items'] : array();
			$activeChild = self::getActiveChildren($app_items);
			if($activeChild)
			{
				self::$breadCrumbNodes[] = $menuItem;
			}

			if(!is_array($menuItem['module']))
			{
				$menuItem['module'] = array($menuItem['module']);
			}

			if(in_array(sfContext::getInstance()->getModuleName(), $menuItem['module']))
			{
				self::$active = $menuItem;
				$active = true;
			}

			if($active || $open || $activeChild)
			{
				self::getBreadCrumb($app_items, $open);
			}
		}

		return self::$breadCrumbNodes;

	}

	static public function getActive()
	{
		return self::$active;
	}

	/**
	 * parse a menu item node defined in app.yml
	 * Also checks for modifications defined in module.yml
	 * Also checks for items into the request attribute __MG_JSCLASS, looking for any
	 * defined menu shortcut. In that case, it makes sure the appropiate javascripts are loaded/written.
	 *
	 * @param   $node    string   The menu node took for in app.yml
	 * @param   $module  string   The module name -to look for module.yml in the proper place-
	 *                          or 'before' the inner<code><ul></code>element.
	 * @returns string   the <code><li></code> element representing the node or false otherwise
	 */
	static private function parseMenuItem($node,$module,$html_attrs,$open)
	{
		$menuItem = sfConfig::get('app_'.__MG_CONFIG.$node,null);
		$active = false;
		$app_items = isset($menuItem['items']) ? $menuItem['items'] : array();
		$app_allow = isset($menuItem['allow']) ? $menuItem['allow'] : array();
		$app_deny = isset($menuItem['deny']) ? $menuItem['deny'] : array();
		$app_attr = isset($menuItem['attr']) ? $menuItem['attr'] : array();
		$htmlattrs = array();
		$aattrs = array();

		$activeChild = self::getActiveChildren($app_items);

		if($modMI = sfConfig::get('mod_'.$module.'_'.__MG_CONFIG.$node,null))
		{
			foreach($modMI as $key=>$value)
			{
				if($key == 'items')
				{
					$app_items = self::mergeMenuItems($app_items,$value) ;
				}
				else if($key == 'allow')
				{
					$app_allow = self::mergeMenuItems($app_allow,$value);
				}
				else if($key == 'deny')
				{
					$app_deny = self::mergeMenuItems($app_deny,$value);
				}
				else
				{
					$menuItem[$key] = $value ;
				}
			}
		}


		if(!$menuItem)
		{
			return false;
		}
		$menuItem['html_class'] = isset($menuItem['html_class']) ? $menuItem['html_class'] : '' ;

		$app_allow = count($app_allow)>0 ? $app_allow : array('any') ;


		if(!self::matchUserCredentials($app_allow,$app_deny))
		{
			return false ;
		}

		$aattrs['class'] = '';
		foreach($menuItem as $key=>$value)
		{
			if(substr($key,0,5) == 'html_')
			{
				if($value)
				{
					$htmlattrs[substr($key,5)] = $value;
				}
			}
			if(substr($key,0,2) == 'a_')
			{
				if($value)
				{
					$aattrs[$substr($key,2)] = $value;
				}
			}
		}

		foreach($app_attr as $key=>$value)
		{
			if($value)
			{
				$attrArr = explode(':',$value);
				$aattrs[$attrArr[0]] = trim($attrArr[1]);

			}
		}

		if(!is_array($menuItem['module']))
		{
			$menuItem['module'] = array($menuItem['module']);
		}

		if(in_array(sfContext::getInstance()->getModuleName(), $menuItem['module']))
		{
			$active = true;
			$aattrs['class'] = $aattrs['class'].' act';
		}

		if($active || $open || $activeChild)
		{
			return content_tag('li',
					link_to(
					(isset($menuItem['text'])?__($menuItem['text']):''),
					(isset($menuItem['link'])?$menuItem['link']:'#'),
					$aattrs
					).self::getMenu($app_items,$html_attrs,$open),
					$htmlattrs
			);
		}
		else
		{
			return content_tag('li',
					link_to(
					(isset($menuItem['text'])?__($menuItem['text']):''),
					(isset($menuItem['link'])?$menuItem['link']:'#'),
					$aattrs
					),
					$htmlattrs
			);
		}
	}


	/**
	 *
	 * Merge the [items] section that may overlap between two nodes with the same name, located on different
	 * config files (app.yml and module.yml).
	 * It follows the same structure than "stylesheets" section on the view.yml files.
	 * For instance,
	 * <emph>app.yml</emph>
	 * <code>
	 * ....
	 * sf_menu_generator:
	 *   users:
	 *     ...
	 *     items: [ newuser, listuser]
	 * ....
	 * </code>
	 * <emph>module.yml</emph>
	 * <code>
	 * ....
	 * sf_menu_generator:
	 *   users:
	 *     ...
	 *     items [ modifyuser, -listuser]
	 * </code>
	 *
	 * In this case, the conflicting items secions are [newuser, listuser] and [modifyuser, -listuser]
	 * given that the last one (defined in module.yml) have precedence over the previous one (defined in app.yml)
	 * the resulting items would be: [newuser, modifyuser] (we added modfyuser and removed listuser, as
	 * indicated in the latest <emph>items</emph> section.
	 *
	 * @param   $app_items   array    array with the 'items' section of some node defined in app.yml
	 * @param   $mod_items   array    array with the 'items' section of some node defined in module.yml,
	 *                                which has precedence when merging.
	 * @returns array                 the resulting merged array.
	 */
	static private function mergeMenuItems($app_items, $mod_items)
	{
		foreach($mod_items as $mod_item)
		{
			if($mod_item == '-*')
			{
				$app_items = array();
			}
			else if($mod_item{0} == '-')
			{
				if(($pos = array_search(substr($mod_item,1),$app_items))!== false)
				{
					array_splice($app_items,$pos,1);
				}
			}
			else if(!in_array($mod_item,$app_items))
			{
				$app_items[] = $mod_item;
			}
		}
		return $app_items ;
	}

	/**
	 * mg_match_user_credentials
	 * match user credentials against an 'allow' and 'deny' array
	 *
	 * @param  $app_allow  array  The credentials allowed
	 * @param  $app_deny   array  The credentials denied
	 * @return boolean     'true' if both the user credentials is within 'app_allow' and
	 *                            not in 'app_deny'.
	 */
	static private function matchUserCredentials($app_allow,$app_deny)
	{
		$user = sfContext::getInstance()->getUser();

		if(count(array_intersect($app_deny,$user->getCredentials())) > 0)
		{
			return false;
		}

		foreach($app_allow as $allow)
		{
			if(($user->hasCredential($allow) || $allow == 'any'))
			{
				return true;
			}
		}
		return false;
	}
}
?>
