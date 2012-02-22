<?php
class Zwas_FileObject extends SplFileObject {
	
	public function __construct($file_name, $open_mode = 'r', $use_include_path = false, $context = NULL) {
		try {
			parent::__construct($file_name, $open_mode, $use_include_path);
		} catch (Exception $e) {
			$error = self::extractError($e->getMessage());
			if ($error) {
				throw new Zwas_Exception("$error '$file_name'");
			}
			throw new Zwas_Exception(new Zwas_Text(	Zwas_Translate::_("An internal error occurred while trying to open file '%s'"),
													array($file_name)));
		}
	}
	
	/**
	 * Returns the file last modification time
	 *
	 * @return int
	 */
	public function getMTime() {
		// Clear the cached information between calls (for cases the file is changed between 2 function calls)
		clearstatcache();
		return parent::getMTime();
	}
	
	/**
	 * Returns the file content
	 *
	 * @return string
	 */
	public function readAll() {
		$content = array();
		
		foreach ($this as $line) {
			$content[] = $line;
		}
		
		return implode('', $content);
	}
	
	/**
	 * Extracts a clean error message from the SPLFileObject exception error
	 *
	 * For example:
	 * "SplFileObject::__construct(/usr/local/zend/etc/page_cache_deps.xml) [splfileobject.--construct]: failed to open stream: No such file or directory
	 * It will return a string 'No such file or directory'
	 *
	 * @param string $message
	 * @return string
	 */
	static private function extractError($message) {
		$pos = strrpos($message, ':');
		if ($pos !== false) {
			return substr($message, ($pos + 2));
		}
		return $pos;
	}
}
