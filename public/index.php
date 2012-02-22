<?php

// Define path to application directory

// test for git
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Define subdomian  to aid branching and uri writes for image locations etc.
	defined('APPLICATION_SUBDOMAIN')
    || define('APPLICATION_SUBDOMAIN', (getenv('APPLICATION_SUBDOMAIN') ? getenv('APPLICATION_SUBDOMAIN') : 'toolkit'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// set  timezone
date_default_timezone_set('UCT');


/** Zend_Application */
require_once 'Zend/Application.php';  

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV, 
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();