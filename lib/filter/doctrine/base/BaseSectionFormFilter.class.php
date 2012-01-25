<?php

/**
 * Section filter form base class.
 *
 * @package    PhotoSite
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSectionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'online'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sort_order' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'online'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sort_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('section_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Section';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'online'     => 'Boolean',
      'sort_order' => 'Number',
    );
  }
}
