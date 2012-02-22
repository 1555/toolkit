<?php

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * test case.
 */
class ControllerTestCase extends PHPUnit_Framework_TestCase {
	
	/**
	 * Prepares the environment before running a test.
	 * 
	 * 
	 */
	
	protected $application;
	
	protected function setUp() {
	
		
		// TODO Auto-generated ControllerTestCase::setUp()
		$this->bootstrap = array($this, 'appBootstrap');
		parent::setUp ();
	}
	
	public function appBootstrap(){
		$this->application = new Zend_Application(APPLICATION_ENV,
												APPLICATION_PATH . '/configs/application.ini');
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ControllerTestCase::tearDown()
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

}

