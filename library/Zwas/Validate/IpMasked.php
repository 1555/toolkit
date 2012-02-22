<?php
require_once 'Zend/Validate/Abstract.php';
/**
 * Validate IPs of the following format:
 * 10.1.1.1
 * 10.1.1.1/32
 * 10.*.*.*
 */
class Zwas_Validate_IpMasked extends Zend_Validate_Abstract {
	
	const INVALID_IP = 'invalidIp';
    
	protected $_messageTemplates = array(
        self::INVALID_IP => "'%value%' is not a valid ip"
    );
    
	public function isValid($value) {
		
		$validator = new Zwas_Validate_Ip();
		
		// Check for simple IP values
		if (preg_match('#^[0-9]{1,3}(?:\.[0-9]{1,3}){3}$#', $value)) {
			return $validator->isValid($value);
		}
		
		// Check for IP with mask
		$matches = array();
		if (preg_match('#^([0-9]{1,3}(?:\.[0-9]{1,3}){3})\/([0-9]{1,2})$#', $value, $matches)) {
			list($dummy, $ip, $mask) = $matches;
			return (($mask >= 0) && ($mask <= 32) && $validator->isValid($ip));
		}
		
		// Check for IP with asterisk
		if (preg_match('#^(?:[0-9]{1,3}(?:\.[0-9]{1,3}){0,3})(?:\.\*){1,3}$#', $value)) {
			$ip = str_replace('*', '0', $value);
			return $validator->isValid($ip);
		}
		
		if ('*.*.*.*' === $value) {
			return true;
		}
		
		return false;
	}
}