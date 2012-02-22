<?php

// 'source' bootstrap


class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	private $_acl = null;
	
    protected function _initAutoload() {
    	
        $modelLoader = new Zend_Application_Module_Autoloader(array('namespace' => '', 'basePath' => APPLICATION_PATH.'/modules/default'));
      
        
        // sets up a defulat role if one hasnt already been set in Auth
		if(Zend_Auth::getInstance()->hasIdentity()) {
			Zend_Registry::set('role', Zend_Auth::getInstance()->getStorage()->read()->role);
		} else {
			Zend_Registry::set('role', 'guests');
		}
		
		// sets up the acl - this is located in modules/default/models/
		  $this->_acl = new Model_CNBCAcl;
		  
        $this->_auth = Zend_Auth::getInstance();
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		Zend_Registry::set('config', $config);
		require_once 'Zend/Loader/Autoloader.php';
		$autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('cnbc');
      	$fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Plugin_AccessCheck($this->_acl));
        
        return $modelLoader;
    }
	
	function _initViewHelpers() {
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$view->addHelperPath(dirname(__FILE__) . '/views/helpers', 'MRV_View_Helper');
		$view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
		
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8')->appendName('description', 'Your Local Toolkit');
		$view->doctype('HTML4_STRICT');
		
		$view->headTitle('CNBC - Web Toolkit');
		$view->title = "CNBC EMEA Web Toolkit v 1.01";	
		
		$navContainerConfig = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
		$navContainer = new Zend_Navigation($navContainerConfig);
		
		date_default_timezone_set('UCT');
		
		$view->navigation($navContainer)->setAcl($this->_acl)->setRole(Zend_Registry::get('role'));
		Zend_Dojo::enableView($view);
		Zend_Dojo_View_Helper_Dojo::setUseDeclarative();
		
	}
	
	protected function _initLog(){
    	if($this->hasPluginResource("log")){
    		$r = $this->getPluginResource("log");
    		$log = $r->getLog();
    		Zend_Registry::set('log', $log);
    	}
    }

}
	
	


