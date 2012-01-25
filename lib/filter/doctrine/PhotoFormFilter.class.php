<?php

/**
 * Photo filter form.
 *
 * @package    PhotoSite
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PhotoFormFilter extends BasePhotoFormFilter
{
  public function configure()
  {
      $this->options['query'] = Doctrine::getTable('Photo')->createQuery()->orderBy('category_id');
  }

}
