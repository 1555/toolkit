<?php
require_once 'Zend/Validate/Hostname.php';
require_once 'Zend/Validate/Between.php';
// TODO: (z) consider replace this with Zwas_Validate_U
class Zwas_Validate_ServerAddress extends Zend_Validate_Abstract {
	
	const INVALID_SERVER_ADDRESS	= 'invalidServerAddress';
	const INVALID_PORT 				= 'invalidPort';
	const INVALID_SCHEMA			= 'invalidSchema';
    

	protected $schema, $port, $host;
	
	protected $_messageTemplates = array(
        self::INVALID_SERVER_ADDRESS 	=> "'%value%' is not a valid server address",
        self::INVALID_SCHEMA 			=> "'%value%' has an invalid schema",
        self::INVALID_PORT 				=> "'%value%' has an invalid port",
    );
    
    private $allowedSchemas = array(
    	'http',
    	'https',
    	'tcp'
    );
    
	public function isValid($value) {
		$this->_setValue($value);
		
		$parts = array();
		
		if (preg_match('#^(?:(.+)\:\/\/)#', $value, $parts)) {
			$this->schema = $parts[1];
		}
		
		if (preg_match('#\:([0-9]+)$#', $value, $parts)) {
			$this->port = $parts[1];
		}
		
		if (preg_match('#/?([^:]+):?#', $value, $parts)) {
			$this->host = $parts[1];
		}
				
		
		if ($this->schema) {
			$schemaValidator = new Zend_Validate_InArray($this->allowedSchemas);
			if (! $schemaValidator->isValid($this->schema)) {
				$this->_error(self::INVALID_SCHEMA);
				return false;
			}
		}
		
		$hostnameValidator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_ALL);
		$maskedIp = new Zwas_Validate_IpMasked();
		$numbersOnly = new Zend_Validate_Digits();
		// Not a masked ip or a valid hostname/ip address
		if (((! $maskedIp->isValid($this->host)) &&
			(! $hostnameValidator->isValid($this->host)))
			/**
			 * Used to identify the "arbitrary numbers only" edge case
			 * @see Zwas_Validate_ServerAddressTest::testServerAddressArbitraryNumber
			 */ 
			|| ($numbersOnly->isValid($this->host))) {
			$this->_error(Zend_Validate_Hostname::INVALID_HOSTNAME);
			return false;
		}
		
		if ($this->port) {
			$portValidator = new Zwas_Validate_Port();
			if ((is_null($this->schema)) || (! $portValidator->isValid($this->port))) {
				$this->_error(self::INVALID_PORT);
				return false;
			}
		}
		return true;
	}
	
}