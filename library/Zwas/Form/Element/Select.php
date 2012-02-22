<?php
require_once 'Zend/Form/Element/Select.php';

class Zwas_Form_Element_Select extends Zend_Form_Element_Select {

	public function init() {
		parent::init();
		$this->setAttrib('dojoType', 'zend.widget.select');
		$this->setDecorators(array('ViewHelper'));
	}

}
