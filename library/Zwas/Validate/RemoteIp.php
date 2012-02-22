<?php
require_once ('Zend/Validate/Ip.php');

/**
 * This is an IP validator which asserts that the IP given is not a localhost IP (e.g. 127.x.x.x)
 */
class Zwas_Validate_RemoteIp extends Zend_Validate_Ip {
	
	const NOT_LOCAL_IP_ADDRESS = 'notLocalIpAddress';
	
	public function __construct() {
		parent::__construct();
		$this->_messageTemplates[self::NOT_LOCAL_IP_ADDRESS] = Zwas_Translate::_("'%value%' is not a valid remote ip");
	}
	
	/**
	 * @param mixed $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (parent::isValid($value)) {
			// Check that the IP is not a local machine
			if ('0.0.0.0' === $value) {
				$this->_error(self::NOT_LOCAL_IP_ADDRESS);
				return false;
			}
			$ipRange = new Zwas_Validate_IpRange('127.0.0.0', 8);
			if ($ipRange->isValid($value)) { // if the IP is in the range, it's bad
				$this->_error(self::NOT_LOCAL_IP_ADDRESS);
				return false;
			}
			return true;
		}
		return false;
	}



}
