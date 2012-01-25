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
class LanguageComponents extends sfComponents
{
	public function executeLanguage(sfWebRequest $request)
	{
		$this->form = new sfFormLanguage(
				$this->getUser(),
				array('languages' => array('de', 'en'))
		);
	}
}
?>
