<?php
require_once 'Zend/Validate/Hostname.php';
require_once 'Zend/Validate/Between.php';
// TODO: (z) consider replace this with Zwas_Validate_U
class Zwas_Validate_AdminInterfaceAddress extends Zend_Validate_Abstract {
	
	const INVALID_SERVER_ADDRESS	= 'invalidServerAddress';
	const INVALID_PORT 				= 'invalidPort';
	const INVALID_SCHEMA			= 'invalidSchema';
    
	protected $_messageTemplates = array(
        self::INVALID_SERVER_ADDRESS 	=> "'%value%' is not a valid server address",
        self::INVALID_SCHEMA 			=> "'%value%' has an invalid schema",
        self::INVALID_PORT 				=> "'%value%' has an invalid port",
    );
    
    private $allowedSchemas = array(
    	'http',
    	'https'
    );
    
	public function isValid($value) {
		$this->_setValue($value);
		
		$parts = array();
		
		if (! preg_match('#^(?:(.+)\:\/\/)?(.+)\:([0-9]+)$#', $value, $parts)) {
			$this->_error(self::INVALID_SERVER_ADDRESS);
			return false;
		}
		
		if (4 != count($parts)) {
			$this->_error(self::INVALID_SERVER_ADDRESS);
			return false;
		}
		
		$schema = strtolower($parts[1]);
		$schemaValidator = new Zend_Validate_InArray($this->allowedSchemas);
		if (! $schemaValidator->isValid($schema)) {
			$this->_error(self::INVALID_SCHEMA);
			return false;
		}
		
		$hostnameValidator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);
		if (! $hostnameValidator->isValid($parts[2])) {
			$this->_error(Zend_Validate_Hostname::INVALID_HOSTNAME);
			return false;
		}
	
		$portValidator = new Zwas_Validate_Port();
		if (! $portValidator->isValid($parts[3])) {
			$this->_error(self::INVALID_PORT);
			return false;
		}
		return true;
	}
	
}