<?php
/**
 * MyWiki/Db.php 
 * 
 * File contains the MyWiki_Db class.
 * Creates a connection on instantiation 
 * 
 * @author Zend Technologies Inc.
 */

require_once 'Zend/Registry.php';
require_once 'Zend/Db.php';
require_once 'cnbc/Log.php';

/**
 * MyWiki_Db
 * Class contains methods for manipulating the WIKI data stored
 * in SQLite database.
 *
 */
class Cnbc_Db 
{
    protected static $_adapter;
    
    /**
     * We make sure that only one instance of the database is passed around
     *
     * @return mixed
     */
    
    public static function getAdapter($__configmod)   
    {
        if (self::$_adapter === null) {
            try {
            	$reg = Zend_Registry::getInstance();
        		$config = $__configmod;
            // Get a connection to the database
              self::$_adapter = Zend_Db::factory($config);
             $conn = self::$_adapter->getConnection();
          
            } catch (Zend_Db_Adapter_Exception $e) {
                // perhaps a failed login credential, or perhaps the RDBMS 
                // extension is not loaded
            //    Filmed_Log::getLogger()->err($e->getMessage());
               throw $e;
            } catch (Zend_Exception $e) {
                // perhaps factory() failed to load the specified adapter class
             // Filmed_Log::getLogger()->err($e->getMessage());
               throw $e;
            }
        }
        
        return self::$_adapter;
    }    
    
    protected function __construct()
    {
    }
}
