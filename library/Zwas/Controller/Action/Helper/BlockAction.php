<?php
require_once 'Zend/Loader/PluginLoader.php';
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Authenticate Action Helper 
 * 
 * @uses actionHelper Zend_Controller_Action_Helper
 */
class Zwas_Controller_Action_Helper_BlockAction extends Zend_Controller_Action_Helper_Abstract {

	/**
	 * A semaphore to mark if the controller's action had to be skipped
	 * @var boolean
	 */
	private $block = false;

	public function block() {
		$this->block = true;
		$this->getRequest()->setDispatched(false);
	}
	
	public function postDispatch() {
		if (true === $this->block) {
			$this->getRequest()->setDispatched(true);
		}
	}
		
	/**
	 * Strategy pattern: call helper as broker method
	 */
	public function direct() {
		$this->block();
	}
	
}

