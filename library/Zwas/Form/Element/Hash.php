<?php
require_once ('Zend/Form/Element/Hash.php');

class Zwas_Form_Element_Hash extends Zend_Form_Element_Hash {
	
	public function init() {
		parent::init();
		$this->setOptions(array('ignore' => true));
	}

}
