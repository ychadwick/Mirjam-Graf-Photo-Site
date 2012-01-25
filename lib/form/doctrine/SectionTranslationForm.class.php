<?php

/**
 * SectionTranslation form.
 *
 * @package    PhotoSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SectionTranslationForm extends BaseSectionTranslationForm {
    public function configure() {
        unset($this['slug']);
        if(!$this->isNew) {
            $this->validatorSchema->setPostValidator(new sfValidatorPass());
        }
    }
}
