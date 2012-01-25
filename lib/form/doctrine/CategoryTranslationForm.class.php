<?php

/**
 * CategoryTranslation form.
 *
 * @package    PhotoSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryTranslationForm extends BaseCategoryTranslationForm {
    public function configure() {
        if(!$this->isNew){
            $this->validatorSchema->setPostValidator(new sfValidatorPass()); 
        }

        $this->widgetSchema['content'] = new sfWidgetFormTextarea(array(), array('rows' => 20));

        $this->useFields(array('title', 'content'), true);
    }
}
