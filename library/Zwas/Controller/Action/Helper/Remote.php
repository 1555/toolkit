<?php

class Zwas_Controller_Action_Helper_Remote extends Zend_Controller_Action_Helper_Abstract {
	
	public function send(Node_Response $response) {
		$this->getResponse()->appendBody( Zwas_Package::pack($response) );
		Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setNoRender();
	}
	
	public function direct(Node_Response $response) {
		return $this->send($response);
	}
}