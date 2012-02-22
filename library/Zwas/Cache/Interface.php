<?php

interface Zwas_Cache_Interface {

	/**
	 * Save data in cache
	 * 
	 * @param string $id	Access key for storing/fetching data		
	 * @param mixed $data	Data to cache
	 * @param integer $ttl	Time to leave (seconeds) 
	 * @return boolean		true if data stored succesfully, otherwise false
	 */
	public function store($id, $data, $ttl);
	
	/**
	 * Fetch data from cache
	 * 
	 * @param string $id	Access key for storing/fetching data
	 * @return mixed		Return the cache data or null if cache is invalid (Pass ttl, key not exist etc.)
	 */
	public function fetch($id);
	
	/**
	 * Check for cache if exist and valid
	 * 
	 * @param string $id	Access key for storing/fetching data
	 * @return boolean		true if the key exist and ttl is still valid
	 */
	public function exist($id);
}