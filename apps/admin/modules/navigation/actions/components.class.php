<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of componentsclass
 *
 * @author yorkie
 */
class NavigationComponents extends sfComponents
{
	public function executeNavigation(sfWebRequest $request)
	{
		$nodes = $this->getVar('nodes');
		$htmlAttrs = $this->getVar('htmlAttrs');
		$open = $this->getVar('open');
		$this->menuHtml = CustomMenu::getMenu($nodes, $htmlAttrs, $open);
	}

	public function executeBreadcrumb(sfWebRequest $request)
	{
		$nodes = $this->getVar('nodes');
		$open = $this->getVar('open');
		$this->breadcrumb = CustomMenu::getBreadCrumb($nodes, $open);

		$this->breadcrumb[] = CustomMenu::getActive();
	}
}
?>
