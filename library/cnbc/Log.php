<?php
/**
 * cnbc/Log.php
 * 
 * @author Zend Technologies Inc.
 */


require_once 'Zend/Log.php';
require_once 'Zend/Registry.php';
require_once 'Zend/Log/Writer/Stream.php'; 

/**
 * MyWiki_Log
 *
 * Logs all messages to a log file
 * path to log file defined in configs
 * 
 */
class cnbc_Log // extends Zend_Log  
{
    protected $logger;
    static $fileLogger = null;
    
    protected function __construct(){
    	$this->logger = Zend_Registry::get('log');
    }

    public static function getInstance()   
    {
       if (self::$fileLogger == null){
       	 self::$fileLogger = new self();
       }
       
       return self::$fileLogger;
		
		
    }
    
    public function getLog(){
    	return $this->logger;
    }
    
    public static function info($message){
    	self::getInstance()->getLog()->info($message);
    }
    
    
}
