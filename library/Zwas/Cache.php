<?php

class Zwas_Cache {
	
	const STORAGE_ZEND_DATA_DISK	= 0;
	const STORAGE_ZEND_DATA_SHM		= 1;
	const STORAGE_FILE				= 3;
	
	/**
	 * @param int const $storage
	 * @return Zwas_Cache_Interface
	 * @throws an exception if storage is not defined
	 */
	public static function factory($storage) {
		switch ($storage) {
			case Zwas_Cache::STORAGE_ZEND_DATA_DISK:
				return new Zwas_Cache_ZendDataCache_Disk();
				break;
				
			case Zwas_Cache::STORAGE_ZEND_DATA_SHM:
				return new Zwas_Cache_ZendDataCache_Memory();
				break;
				
			case Zwas_Cache::STORAGE_FILE:
				return new Zwas_Cache_File();
				break;
				
			default:
				throw new Zwas_Exception('Unknown cache storage', Zwas_Exception::ASSERT);
		}
	}
}