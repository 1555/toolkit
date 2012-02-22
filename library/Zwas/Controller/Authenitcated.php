<?php
class Zwas_Controller_Authenitcated extends Zwas_Controller_Action {
	
	public function preDispatch() {
		// authentication
		if (Zend_Auth::getInstance()->hasIdentity()) {
			
			// Check if the current login is still relevant for the current password (ticket 22198)
			if ((! Zend_Auth::getInstance()->getIdentity()->isMarkerValid()) || (! $this->refererCheck())) {
				$this->redirect(array('controller' => 'Login', 'action' => 'Js-Leave'));
			}
			
			
		} else {
			
			// check if this is a request with an authentication token (Zend Control Applet)
			$token = $this->getTrimmedParam('token');
			if (! empty($token)) {
				// TODO: Authentication_TokenAdapter is not part of the library/Zwas so it should not be used here or moved in the library
				Zend_Auth::getInstance()->authenticate(new Authentication_TokenAdapter($token));
			}
			
			// has the authentication status changed?
			if (! Zend_Auth::getInstance()->hasIdentity()) {
				
				// Check authentication of a ZSM request
				$userAgent	= $this->getRequest()->getHeader('USER_AGENT');
				$authKey	= $this->getRequest()->getPost('nodekey');
				if (defined('ZEND_SERVER_USER_AGENT') && 
					(ZEND_SERVER_USER_AGENT == $userAgent) &&
					(! empty($authKey))) {
					
					Zend_Auth::getInstance()->authenticate(new Authentication_NodeAdapter($authKey));
				}
			}
			
			// has the authentication status changed?
			if (! Zend_Auth::getInstance()->hasIdentity()) {

				// if the result come from ZSM communication - return Node_Response
				$userAgent = $this->getRequest()->getHeader('USER_AGENT');
				if (defined('ZEND_SERVER_USER_AGENT') &&
				 	((ZEND_SERVER_USER_AGENT == $userAgent) || (ApplicationModel::isNode()))) {
				 		$response = Node_Response::factory(false, 4001, 'Authentication failure');
				 		/// if the view was already initialized, use it instead
				 		if ($this->getHelper('viewRenderer')->view instanceof View_Remote) {
				 			$this->getHelper('viewRenderer')->view->setViewData($response);
				 		} else {
				 			$this->_helper->remote($response);
				 		}
					
						$this->_helper->blockAction();
				} else {
					$this->redirect(array('controller' => 'Login', 'action' => 'Js-Leave'));
				}
			}
		}
	}
	
	protected function refererCheck() {
		if (!isset($_SERVER['HTTP_REFERER'])) {
			return true;
		}
		if (preg_match("#^https?:\/\/{$_SERVER['HTTP_HOST']}#i", $_SERVER['HTTP_REFERER'])) {
			return true;
		}
		// TRANSLATE
		Error_Logger::logMessage("Referer: '{$_SERVER['HTTP_REFERER']}' does not match your host: '{$_SERVER['HTTP_HOST']}'", Zend_Log::CRIT);
		return false;
	}
	
}
