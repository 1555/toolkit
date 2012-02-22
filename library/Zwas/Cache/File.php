<?php
class Zwas_Cache_File implements Zwas_Cache_Interface {

	/**
	 * @var string
	 */
	private $savePath;
	
	
	/**
	 * @param string $savePath
	 */
	public function __construct($savePath) {
		if (! is_dir($savePath)) {
			throw new Zwas_Exception("The save path $savePath : is not a directory", Zwas_Exception::ASSERT);
		}
		if (! is_writable($savePath)) {
			throw new Zwas_Exception("The save path $savePath : is not writable", Zwas_Exception::ASSERT);
		}
		$this->savePath = $savePath;
	}

	/**
	 * @see Zwas_Cache_Interface::store()
	 *
	 * @param string $id
	 * @param mixed $data
	 * @param integer $ttl
	 * @return boolean
	 */
	public function store($id, $data, $ttl) {
		$cachedData = serialize(array(	'data'	=> $data,
										'ttl'	=> time()+$ttl));

		$filePath = $this->getFilePath($id);
		
		if (is_writeable($filePath) || is_writeable(dirname($filePath))) {
			return (false !== file_put_contents($filePath, $cachedData));
		}
		return false;
	}
	
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function fetch($id) {
		try {
			$cachedData = $this->readCachedFile($id);
			
		} catch (Zwas_Exception $e) {
			return null;
		}
		return ($cachedData['ttl'] > time()) ? $cachedData['data'] : null;
	}
	
	/**
	 * @param string $id
	 * @return boolean
	 */
	public function exist($id) {
		try {
			$cachedData = $this->readCachedFile($id);
			
		} catch (Zwas_Exception $e) {
			return false;
		}
		return ($cachedData['ttl'] > time());
	}
	
	/**
	 * @param string $id
	 * @return array
	 * @throws Zwas_Excpetion for all failures
	 */
	private function readCachedFile($id) {
		$filePath = $this->getFilePath($id);
		
		if (! file_exists($filePath)) {
			throw new Zwas_Exception("Cache file '$filePath', does not exist", Zwas_Exception::ASSERT);
		}
		
		$content = file_get_contents($filePath);
		if (false === $content) {
			throw new Zwas_Exception("Cache file '$filePath' is not readable", Zwas_Exception::ASSERT);
		}
		
		$cachedData = unserialize($content);
		if ((false === $cachedData) ||						// unserialize fail
			(! is_array($cachedData)) ||					// data is not array
			(! array_key_exists('ttl', $cachedData)) ||		// data is not valid
			(! array_key_exists('data', $cachedData))) {	// data is not valid
				
				throw new Zwas_Exception('Cache file content is not valid', Zwas_Exception::ASSERT);
			}
		return $cachedData;
	}
	
	/**
	 * @param string $id
	 * @return string
	 */
	private function getFilePath($id) {
		return Zwas_Path::create($this->savePath, md5($id));
	}
}