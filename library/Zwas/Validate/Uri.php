<?php
require_once 'Zend/Validate/Hostname.php';
require_once 'Zend/Validate/Between.php';

class Zwas_Validate_Uri extends Zend_Validate_Abstract {
	
	protected $exception;
	
	protected $_messageVariables = array('exception' => 'exception');

    protected $_messageTemplates = array('%exception%');
	
	public function isValid($value) {
		$this->_setValue($value);

		try {
			Zend_Uri::factory($value);
			
		} catch (Zend_Exception $e) {
			$this->exception = $e->getMessage();
			$this->_error('exception');
			return false;
		}
		return true;
	}
	
}