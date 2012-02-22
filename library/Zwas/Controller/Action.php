<?php

class Zwas_Controller_Action extends Zend_Controller_Action {

	/**
	 * @var string
	 */
	protected $controllerName;
	
    /**
     * Initialize object
     * Called from {@link __construct()} as final step of object instantiation.
     * @return void
     */
    public function init() {
		parent::init();
		$this->controllerName = $this->getRequest()->getControllerName();
	}
	
	/**
	 * Wrapper Zend_Controller_Action::_forward
	 *
	 * @param string $action
     * @param string $controller
     * @param string $module
     * @param array $params
	 */
	public function forward($action, $controller = null, $module = null, array $params = array()) {
		if (ApplicationModel::isNode()) {
			Node_ControllerParams::getInstance()->setForward($action, $controller, $module, $params);
		} else {
			$this->_forward($action, $controller, $module, $params);
		}
	}
	
	/**
	 * Wrapper for Zend_Controller_Action::render
	 *
	 * @param string $action
	 * @param string $name
	 * @param boolean $noController
	 */
	public function render($action = null, $name = null, $noController = false) {
		if (ApplicationModel::isNode()) {
			Node_ControllerParams::getInstance()->setRender($action, $name, $noController);
			
		} else {
			parent::render($action, $name, $noController);
		}
	}
	
	/**
	 * Wrapper for Zend_Controller_Action::renderScript
	 *
	 * @param string $script
	 * @param string $name
	 */
	public function renderScript($script, $name = null) {
		if (ApplicationModel::isNode()) {
			Node_ControllerParams::getInstance()->setRenderScript($script, $name);
		} else {
			parent::renderScript($script, $name);
		}
	}
	/**
	 * Sets the message to be displayed in the view's message pane
	 * @param MessagePane_Abstract $message
	 */
	public function setMessagePane(MessagePane_Abstract $message) {
		$this->view->messagePaneObj = $message;
	}
	
	/**
	 * @return boolean
	 */
	protected function isSetMessagePane() {
		return isset($this->view->messagePaneObj);
	}
	
    /**
     * Returns a trimmed paramter value
     * @see Zend_Controller_Action::_getParam
     *
     * @param string $paramName
     * @param mixed $default
     * @return mixed; null if the param didn't exist
     */
	protected function getTrimmedParam($paramName, $default = null) {
		return self::trimParam($this->_getParam($paramName, $default));
	}

	/**
     * Returns a trimmed paramter value
     * @see Zend_Controller_Action::_getAllParams
     *
     * @param string $paramName
     * @return mixed
     */
	protected function getTrimmedParams() {
		return self::trimParam($this->_getAllParams());
	}

   /**
     * Assembles a URL based on a given route and redirect to it
     *
     * @param  array   $urlOptions Options passed to the assemble method of the Route object.
     * @param  mixed   $name       The name of a Route to use. If null it will use the current Route
     * @param  boolean $reset
     * @param  boolean $encode
     */
	protected function redirect($urlOptions = array(), $name = null, $reset = false, $encode = true) {
		$url = $this->_helper->url->url($urlOptions, $name, $reset, $encode);
		$this->_redirect($url, array('prependBase' => false, 'exit' => true));
	}
	
	/**
	 * A wrapper for $this->_helper->url->url()
	 *
	 * @param string $controller
	 * @param string $action
	 * @param array $urlOptions
	 * @return string
	 */
	protected function getUrl($controller, $action, $urlOptions = array()) {
		$urlOptions['controller'] = (string)$controller;
		$urlOptions['action'] = (string)$action;
		return $this->_helper->url->url($urlOptions);
	}
		
	/**
	 * Trim variables and array (incl. multi-dimensional ones)
	 *
	 * @param mixed $value
	 * @return mixed; null if the param didn't exist
	 */
	private static function trimParam($value) {
		if (is_array($value)) {
			return array_map(array('self', __FUNCTION__), $value);
		}
		
		return trim($value);
	}
}
