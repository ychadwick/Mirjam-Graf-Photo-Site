<?php

/**
 * Photo form.
 *
 * @package    PhotoSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PhotoForm extends BasePhotoForm {
    public function configure() {
        unset($this['updated_at'], $this['created_at'], $this['sort_order']);


        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                        'file_src'  => '/uploads/photos/200x200/'.$this->getObject()->getImage(),
                        'is_image'  => true,
                        'edit_mode' => !$this->isNew(),
                        'with_delete' => false,
                        'template'  => '%file%<br /><br />%input%<br /><div class="labelNoFloat">%delete% %delete_label%</div>',
        ));

        $this->validatorSchema['image'] = new sfValidatorFile(  array(
                        'required' => false,
                        'path'       => sfConfig::get('sf_upload_dir').'/photos',
                        'mime_types' => 'web_images')
        );

        //$this->validatorSchema['image_delete'] = new sfValidatorPass();

    }
    protected function processUploadedFile($field, $filename = null, $values = null) {
        // first of all do what this is supposed to do
        $fn = parent::processUploadedFile($field, $filename, $values);

        if(!$this->isNew && !$values[$field])
        {
            return $fn;
        }

        //// and now we can finally start doing additional stuff after the upload hurra
        if ($fn != "" ) {
            // if there is a file, that has been saved
            // multidimensional array that defines the sub-directories to store the thumbnails in
            $thumbnails[]=array('dir' => '400x400', 'width' => 400, 'height' => null);
            $thumbnails[]=array('dir' => '200x200', 'width' => null, 'height' => 200);

            foreach ($thumbnails as $thumbParam) {
                $currentFile = sfConfig::get("sf_upload_dir")."/photos/".$thumbParam["dir"]."/". $fn;
                if (is_file($currentFile)) unlink($currentFile);
            }
            foreach ($thumbnails as $thumbParam) {
                $thumbnail = new sfThumbnail($thumbParam["width"], $thumbParam["height"],true,false);
                $thumbnail->loadFile(sfConfig::get("sf_upload_dir")."/photos/".$fn);
                $thumbnail->save(sfConfig::get("sf_upload_dir")."/photos/".$thumbParam["dir"]."/".$fn, "image/jpeg");
            }
            // do not forget to return the value of the parent-function, otherwise it stops working

            unlink(sfConfig::get("sf_upload_dir")."/photos/".$fn);
            return $fn;

        }
    }
}
