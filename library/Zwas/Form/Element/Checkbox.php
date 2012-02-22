<?php
require_once ('Zend/Form/Element/Checkbox.php');

class Zwas_Form_Element_Checkbox extends Zend_Form_Element_Checkbox {

	public function init() {
		parent::init();
		$this->setAttrib('dojoType', 'zend.widget.input.checkbox');
		$this->setDecorators(array(
			new Zwas_Form_Decorator_FormCheckbox()
		));
	}

}
