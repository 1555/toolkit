<?php

class Zwas_Cache_ZendDataCache_Disk implements Zwas_Cache_Interface {

	/**
	 * @param string $id
	 * @param mixed $data
	 * @param integer $ttl
	 * @return boolean
	 */
	public function store($id, $data, $ttl) {
		return zend_disk_cache_store($id, $data, $ttl);
	}
	
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function fetch($id) {
		return zend_disk_cache_fetch($id);
	}
	
	/**
	 * @param string $id
	 * @return boolean
	 */
	public function exist($id) {
		return (zend_disk_cache_fetch($id) !== null);
	}
}