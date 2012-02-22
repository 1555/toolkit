<?php
require_once ('Zend/Form/Element/Password.php');

class Zwas_Form_Element_Password extends Zend_Form_Element_Password {

	public function init() {
		parent::init();
		$this->setAttrib('dojoType', 'zend.widget.input.password');
		$this->setDecorators(array(
			new Zwas_Form_Decorator_FormPassword()
		));
	}
}
