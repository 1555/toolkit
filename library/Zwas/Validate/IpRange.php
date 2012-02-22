<?php
require_once 'Zend/Validate/Abstract.php';

class Zwas_Validate_IpRange extends Zend_Validate_Abstract {
	
	const INVALID_IP_RANGE = 'invalidIpRange';
    
	protected $_messageTemplates = array(
        self::INVALID_IP_RANGE => "ip '%value%' is not in range"
    );
    
    /**
     * @var string
     */
    private $ip;
    
    /**
     * @var int
     */
    private $mask;
    
    public function __construct($ip, $mask) {
    	$this->setIp($ip);
    	$this->setMask($mask);
    }
    
    /**
     * @param string $ip
     * @return Zwas_Validate_IpRange
     */
    public function setIp($ip) {
    	$this->ip = $ip;
    }
    
    /**
     * @param integer $mask
     * @return Zwas_Validate_IpRange
     */
    public function setMask($mask) {
    	$this->mask = $mask;
    }
    
	public function isValid($value) {
		$this->_setValue($value);
		
		if ($this->mask == 32) {
			return ($value == $this->ip);
				
		} else {
			
			$longValue	= ip2long($value);
			$longHost	= ip2long($this->ip);
			
			$longMask	= (0xffffffff << (32 - $this->mask));
			
			$maskedValue	= $longValue & $longMask;
			$maskedHost		= $longHost & $longMask;
			
			return ($maskedHost == $maskedValue);
		}
	}
	
}