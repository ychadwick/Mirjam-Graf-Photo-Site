<?php

require_once dirname(__FILE__).'/../lib/sectionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sectionGeneratorHelper.class.php';

/**
 * section actions.
 *
 * @package    PhotoSite
 * @subpackage section
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sectionActions extends autoSectionActions
{

    public function executeSortSection(sfWebRequest $request)
    {
        $this->sections = Doctrine::getTable('Section')->
                createQuery()->
                orderBy('sort_order')->
                execute();
    }

    public function executeOrderItems(sfWebRequest $request)
    {
        $this->setLayout(FALSE);

        $secOrder = explode(',', $request->getParameter('secOrder'));

        foreach($secOrder as $key => $section)
        {
            $id = str_replace('sec_', '', $section);

            $section = Doctrine::getTable('Section')->findOneById($id);

            $section->setSortOrder($key);

            $section->save();
        }

        $message = $this->getUser()->setFlash('notice', 'Sort order saved', false);
	return $this->renderPartial('global/flashes');
    }
}
