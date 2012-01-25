<?php

/**
 * portfolio actions.
 *
 * @package    PhotoSite
 * @subpackage portfolio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class portfolioActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        if (!$request->getParameter('sf_culture')) {
            if ($this->getUser()->isFirstRequest()) {
                $culture = $request->getPreferredCulture(array('de', 'en'));
                $this->getUser()->setCulture($culture);
                $this->getUser()->isFirstRequest(false);
            }
            else {
                $culture = $this->getUser()->getCulture();
            }
            $this->redirect('@localized_homepage');
        }
        $this->sections = Doctrine::getTable('Section')->getOnlineSections();
    }

    public function executeShowCategory(sfWebRequest $request) {
        try{
            $this->category = $this->getRoute()->getObject();
        }
        catch(sfError404Exception $e)
        {
            $this->redirect('@localized_homepage');
        }

    }
}
