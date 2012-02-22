<?php

class Zwas_Controller_MainContent extends Zwas_Controller_Authenitcated {
	
	/**
	 * @var $enforceLicense boolean
	 */
	protected $enforceLicense = true;
	
	public function init() {
		parent::init();
		
		if (! ApplicationModel::isNode()) {
			$this->_helper->actionStack('Global-Message', 'Index');
		}

		if ($this->enforceLicense) {
			$licenseControl = Context_Version::getLicenseControl();
			if (! is_null($licenseControl)) {
				$licenseControl->applyLicenseControl($this);
			}
		}
	}
	/**
	 * Triggers the mechanism which locks the content in the main area so links in it
	 * can not be clicked
	 */
	protected function lockContent() {
		$this->_helper->actionStack('lock-content', 'Index');
	}
	
	/**
	* Forward the request after the action according to extra GET parameters passed
	* If no GET parameters passed, go to default
	* @param string $defaultAction
	* @param string $defaultController
	*/
	protected function afterActionForward($defaultAction, $defaultController) {
		$requestObject 	= $this->getRequest();
		$module			= $requestObject->getModuleName();
		$controller		= $requestObject->getParam('trgtController', $defaultController);
		$action			= $requestObject->getParam('trgtAction', $defaultAction);
		
		if (ApplicationModel::isNode()) {
			Node_ControllerParams::getInstance()->setAfterActionForward($action, $controller, $module);
		} else {		
			// save the latest controller and action after a forward which came from an action
			$this->_helper->actionStack('Layout-State', 'Index' , $module,
										array(	'module'		=> $module,
												'controller' 	=> $controller,
												'action'		=> $action,
										));
		}
				
		$this->forward($action, $controller, $module);
	}
}