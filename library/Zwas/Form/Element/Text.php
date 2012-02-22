<?php
require_once ('Zend/Form/Element/Text.php');

class Zwas_Form_Element_Text extends Zend_Form_Element_Text {

	public function init() {
		parent::init();
		$this->setAttrib('dojoType', 'zend.widget.input.text');
		$this->setDecorators(array(
			new Zwas_Form_Decorator_FormText()
		));
	}
}
