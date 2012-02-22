<?php
class Shared_View_Helper_ImageUpload extends Zend_View_Helper_FormFile {

  public function imageUpload($name, $value, $attribs, $options) {
    $str = parent::formFile($name, $attribs = null);

    if(!empty($options[$name])) {
      $str .= $this->getImagePreview($name, $options[$name]);
    } else {
      $str .= $this->getEmptyPreview();
    }
    
    return $str;
  }

  private function getImagePreview($name, $path) {
    $img = ($this->view->doctype()->isXhtml())
       ? '&lt;img src="/'.$path.'" alt="'.$name.'" />'
       : '&lt;img src="/'.$path.'" alt="'.$name.'">';
    
    return '&lt;p class="preview">'.$img.'&lt;/p>';
  }
  
  private function getEmptyPreview() {
    return '&lt;p class="preview">No image uploaded.&lt;/p>';
  }
}
