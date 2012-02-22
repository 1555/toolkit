<?php
/**
 * Adding caching of the result from the XmlRpc requests
 * Caching is valid only for the current request
 */

class Zwas_XmlRpc_CachedClient extends Zend_XmlRpc_Client {
	
	/**
	 * Cache all the remote calls results
	 * The key is the remote method name
	 *
	 * @var array
	 */
	private $cachedResults = array();
	
	/**
     * Send an XML-RPC request to the service (for a specific method)
     *
     * @param string $method Name of the method we want to call
     * @param array $params Array of parameters for the method
     * @return mixed
     * @throws Zend_Exception
     */
	public function cachedCall($method, $params = array()) {
		$key = $this->getCacheKey($method, $params);
		if (! array_key_exists($key, $this->cachedResults)) {
			$this->cachedResults[$key] = parent::call($method, $params);
		}
		return $this->cachedResults[$key];
	}

	
	/**
	 * @see Zend_XmlRpc_Client::call()
	 *
	 * @param string $method
	 * @param array $params
	 * @return mixed
	 */
	public function call($method, $params = array()) {
		$key = $this->getCacheKey($method, $params);
		$this->cachedResults[$key] = parent::call($method, $params);
		return $this->cachedResults[$key];
	}
	
	private function getCacheKey($method, $params = array()) {
		return $method . '_' . md5(serialize($params));
	}
}
