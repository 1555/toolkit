<?php

require_once 'Zend/Form.php';

class Zwas_Form extends Zend_Form {
	
	public function __construct($options= null) {
		parent::__construct($options);
		$this->setMethod(Zend_Form::METHOD_POST);
	}
	
	/**
	 * Process the form elements' data values
	 * This method requires that the form be populated and validated beforehand
	 * Populating is not an option because of subform propagation that is performed 
	 * in both process and populate methods
	 * 
	 * Returns true to signal that processing succeeded
	 * Note that no false is returned - if a subproccess fails, its exception should
	 * propagate through
	 * 
	 * @return boolean
	 * @throws Zwas_Exception
	 */
	public function process() {
		foreach ($this->getSubForms() as $name => $form) {
            if ($form instanceof Zwas_Form) {
                $form->process();
            }
        }
        return true;
	}
}