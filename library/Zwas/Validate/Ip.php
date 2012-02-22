<?php

class Zwas_Validate_Ip extends Zend_Validate_Abstract {
	
	const INVALID_IP = 'invalidIp';
    
	protected $_messageTemplates = array(
        self::INVALID_IP => "'%value%' is not a valid ip"
    );
    
	public function isValid($value) {
		$this->_setValue($value);
		
		$parts = explode('.', $value);
		if (4 != count($parts) || $parts[0] == 0) {
			$this->_error(self::INVALID_IP);
			return false;
		}
	
		foreach ($parts as $part) {
			if (!is_numeric($part) || $part < 0 || $part > 255) {
				$this->_error(self::INVALID_IP);
				return false;
			}
		}
		return true;
	}
}