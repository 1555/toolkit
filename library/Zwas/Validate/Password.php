<?php
require_once 'Zend/Validate/Abstract.php';

class Zwas_Validate_Password extends Zend_Validate_Abstract {
	
	const INVALID_PASSWORD = 'invalidPassword';
	
	private $pattern = '/^[^\x00-\x1f\s]{4,20}$/';
    
	protected $_messageTemplates = array(
        self::INVALID_PASSWORD => "'%value%' is not a valid password"
    );
    
	public function isValid($value) {
        $valueString = (string) $value;

        $this->_setValue($valueString);

        $status = @preg_match($this->pattern, $valueString);

        if (!$status) {
            $this->_error(self::INVALID_PASSWORD);
            return false;
        }
        return true;
	}
}