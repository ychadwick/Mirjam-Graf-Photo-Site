<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class languageActions extends sfActions
{
	public function executeChangeLanguage(sfWebRequest $request)
	{
		$form = new sfFormLanguage(
				$this->getUser(),
				array('languages' => array('de', 'en'))
		);
		$form->process($request);
                
		$referer = sfContext::getInstance()->getRequest()->getReferer();


		$environment = sfConfig::get('sf_environment');
		$parseurl = parse_url($referer);
		$script = ($environment == 'prod') ? $parseurl['host'] : 'admin_dev.php';
		$referer = substr($referer, strpos($referer, $script) + strlen($script));
		$referer = str_replace('/'.$script, '', $referer);

		$params = sfContext::getInstance()->getRouting()->findRoute($referer);
		$params['parameters']['sf_culture'] = $request->getParameter('language');

		return $this->redirect($params['parameters']);
	}
}

?>
