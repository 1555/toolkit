<?php
require_once 'Zend/Validate/Hostname.php';
require_once 'Zend/Validate/Between.php';

class Zwas_Validate_JobQueueBinding extends Zend_Validate_Abstract {
	
	const INVALID_JQBINDING = 'invalidJobQueueBinding';
	
	/**
     * @var array
     */
	protected $_messageTemplates = array(
		// TRANSLATE
        self::INVALID_JQBINDING 		=> "'%value%' is not a valid job queue binding directive"
    );
    
	public function isValid($value) {
		$this->_setValue($value);
		
		$parts = array();
		
		// break jqd address into 4 parts, and validate them one by one
		if (! preg_match('/^tcp\:\/\/(.+)\:([0-9]+)$/', $value, $parts)) {
			$this->_error(self::INVALID_JQBINDING);
			return false;
		}
		
		if (3 != count($parts)) {
			$this->_error(self::INVALID_JQBINDING);
			return false;
		}
		
		$hostnameValidator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);
		if (! $hostnameValidator->isValid($parts[1])) {
			$this->_error(Zend_Validate_Hostname::INVALID_HOSTNAME);
			return false;
		}
		
		$port = $parts[2];
		$portValidator = new Zwas_Validate_Port();
		if (! $portValidator->isValid($port)) {
			$this->_error(self::INVALID_JQBINDING);
			return false;
		}
		
		return true;
	}
    
}