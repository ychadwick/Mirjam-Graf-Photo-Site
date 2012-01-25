<?php

require_once dirname(__FILE__).'/../lib/photoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/photoGeneratorHelper.class.php';

/**
 * photo actions.
 *
 * @package    PhotoSite
 * @subpackage photo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class photoActions extends autoPhotoActions
{

    public function executeSortPhotos(sfWebRequest $request)
    {
        $this->categories = Doctrine::getTable('Category')->
                createQuery()->
                orderBy('section_id, sort_order')->
                execute();
    }

    public function executeOrderItems(sfWebRequest $request)
    {
        $this->setLayout(FALSE);

        $photoOrder = explode(',', $request->getParameter('photoOrder'));

        foreach($photoOrder as $key => $photo)
        {
            $id = str_replace('photo_', '', $photo);

            $photo = Doctrine::getTable('Photo')->findOneById($id);

            $photo->setSortOrder($key);

            $photo->save();
        }

        $message = $this->getUser()->setFlash('notice', 'Sort order saved', false);
	return $this->renderPartial('global/flashes');
    }
}
