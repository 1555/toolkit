<?php

class Zwas_Cache_Null implements Zwas_Cache_Interface {

	/**
	 * @param string $id
	 * @param mixed $data
	 * @param integer $ttl
	 * @return boolean
	 */
	public function store($id, $data, $ttl) {
		return false;
	}
	
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function fetch($id) {
		return null;
	}
	
	/**
	 * @param string $id
	 * @return boolean
	 */
	public function exist($id) {
		return false;
	}
}