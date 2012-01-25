<?php

require_once dirname(__FILE__).'/../lib/categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoryGeneratorHelper.class.php';

/**
 * category actions.
 *
 * @package    PhotoSite
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends autoCategoryActions
{

    public function executeSortCategory(sfWebRequest $request)
    {
        $this->sections = Doctrine::getTable('Section')->
                createQuery()->
                orderBy('sort_order')->
                execute();
    }

    public function executeOrderItems(sfWebRequest $request)
    {
        $this->setLayout(FALSE);
        
        $catOrder = explode(',', $request->getParameter('catOrder'));

        foreach($catOrder as $key => $cat)
        {
            $id = str_replace('cat_', '', $cat);

            $category = Doctrine::getTable('Category')->findOneById($id);

            $category->setSortOrder($key);

            $category->save();
        }

        $message = $this->getUser()->setFlash('notice', 'Sort order saved', false);
	return $this->renderPartial('global/flashes');
    }
}
