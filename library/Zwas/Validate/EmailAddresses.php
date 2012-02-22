<?php
require_once 'Zend/Validate/EmailAddress.php';

class Zwas_Validate_EmailAddresses extends Zend_Validate_Abstract {
	
	const INVALID_SEPARATOR			= 'invalidSeparator';
	const INVALID_EMAIL_ADDRESS		= 'invalidEmailAddress';
    const SEMICOLON = ';';
    const COMMA 	= ','; 
	
	/**
     * @var array
     */
	protected $_messageTemplates = array(
        self::INVALID_SEPARATOR 		=> "'%value%' is not a '%separator%' separated of email address list",
        self::INVALID_EMAIL_ADDRESS 	=> "'%value%' has an invalid email address",
    );
    
    /**
     * email address list separator
     * @var string
     */
    protected $_separator;
    
    /**
     * @var array
     */
    protected $_messageVariables = array(
        'separator' => '_separator'
    );
    
   	public function __construct($separator = self::COMMA) {
   		$this->setSeparator($separator);
   	}
   	
   	/**
   	 * set separtor string
   	 * @param string $separator
   	 * @return Zwas_Validate_EmailAddresses
   	 */
   	public function setSeparator($separator) {
   		$this->_separator = $separator;
   		return $this;
   	}
   	
   	/**
   	 * return string separator
   	 */
   	public function getSeparator() {
   		return $this->_separator;
   	}
    
    /**
     * @see Zend/Validate/Zend_Validate_Interface#isValid()
     */
    public function isValid($value) {
		$this->_setValue($value);
		
		$emails = array();
		$emails = explode($this->_separator, $value);
		$emailValidator = new Zend_Validate_EmailAddress(Zend_Validate_Hostname::ALLOW_ALL);
		
		if (count($emails) > 1) {
			foreach ($emails as $email) {
				if (! $emailValidator->isValid(trim($email))) {
					$this->_error(self::INVALID_EMAIL_ADDRESS);
					return false;
				}
			}
			return true;
		} else {
			if (! $emailValidator->isValid(trim($value))) {
				$this->_error(self::INVALID_SEPARATOR);
				return false;
			}
			return true;
		}
    }
}