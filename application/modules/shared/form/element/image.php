<?php
class Shared_Form_Element_Image extends Zend_Form_Element 
{
  public $helper = "imageUpload";
  public $options;
  
  public function __construct($image_name, $attributes, $data_item) {
    $this->options = $data_item;
    parent::__construct($image_name, $attributes);
  }
}
