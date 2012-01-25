<?php

/**
 * Section form.
 *
 * @package    PhotoSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SectionForm extends BaseSectionForm {
    public function configure() {
        $this->embedI18n(array('de', 'en'));
        $this->widgetSchema->setLabel('de', 'Deutsch');
        $this->widgetSchema->setLabel('en', 'Englisch');
    }
}
