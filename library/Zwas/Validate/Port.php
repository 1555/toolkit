<?php
require_once 'Zend/Validate/Between.php';

class Zwas_Validate_Port extends Zend_Validate_Between {
	
	public function __construct() {
		parent::__construct(1, 65535);
	}
	
}