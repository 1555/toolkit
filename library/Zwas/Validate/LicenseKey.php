<?php

class Zwas_Validate_LicenseKey extends Zend_Validate_Abstract {
	
	const INVALID_STRING_LENGTH		= 1;
	const INVALID_STRING_CHARACTERS	= 2;
	const INVALID_EDITION			= 4;
	const LICENSE_EXPIRED			= 8;
	const LICENSE_INVALID			= 16;
	const LICENSE_SIGNATURE			= 32;
	
	/**
	 * @var string
	 */
	private $edition;
	
	/**
	 * @var string
	 */
	private $user;
	
    public function __construct($user, $edition = ZEND_SERVER_APP_VERSION) {
    	$this->_messageTemplates = array(
	        self::INVALID_STRING_LENGTH 		=> new Zwas_Text(Zwas_Translate::_("'%value%' is not a valid license key. License keys must be exactly %s characters long"), array(License_Model_Abstract::LICENSE_STRING_LENGTH)),
	        self::INVALID_STRING_CHARACTERS 	=> Zwas_Translate::_("'%value%' is not a valid license key. License keys can only include the characters A-Z and 0-9"),
	        // TRANSLATE
	        self::INVALID_EDITION 				=> Zwas_Translate::_("The license key entered is invalid for this version of Zend Server"),
	        // TRANSLATE
	        self::LICENSE_EXPIRED			 	=> Zwas_Translate::_("'%value%' has expired and is no longer valid"),
	        // TRANSLATE
	        self::LICENSE_INVALID			 	=> Zwas_Translate::_("'%value%' is not a valid key"),
	        // TRANSLATE
	        self::LICENSE_SIGNATURE			 	=> Zwas_Translate::_("The order number supplied does not match the license key"),
	    );
	    
	    $this->user = $user;
	    $this->edition = $edition;
    }
    
	public function isValid($value) {
		$this->_setValue($value);
		
   		$licenseValidate = new Zend_Validate_Regex('/\s*\S{' . License_Model_Abstract::LICENSE_STRING_LENGTH . '}\s*/');
		if (! $licenseValidate->isValid($value)) {
			$this->_error(Zwas_Validate_LicenseKey::INVALID_STRING_LENGTH, $value);
			return false;
		}
		
    	$licenseValidate = new Zend_Validate_Regex('/[a-zA-Z0-9]+/');
		if (! $licenseValidate->isValid($value)) {
			$this->_error(Zwas_Validate_LicenseKey::INVALID_STRING_CHARACTERS, $value);
			return false;
		}
		
		$licenseModel = Context_Version::getLicenseModel(Context_Api::getUtilAPI()->getSerialNumberInfo($value, $this->user));
		
		$edition = $licenseModel->getEdition();
		if ($this->edition != $edition) {
			$this->_error(Zwas_Validate_LicenseKey::INVALID_EDITION);
			return false;
		}
		
		if ($licenseModel->isExpired()) {
			$this->_error(Zwas_Validate_LicenseKey::LICENSE_EXPIRED, $value);
			return false;
		}

		return true;
	}
	
	/**
	 * @return integer
	 */
	public function getEdition() {
		return $this->edition;
	}
	
}