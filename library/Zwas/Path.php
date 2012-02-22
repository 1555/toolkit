<?php

class Zwas_Path {
	
	/**
	 * Concatanate and normalize a path according to the operating system
	 * The result path will start with a directory seperator only if such was given on the first argument.
	 * The result will not end with a directory seperator (in case the last parameter is actually a filename)
	 * @example Zwas_Path::create('/usr/local/zend/', '/platform/', '/etc/') will 
	 * 			return "/usr/local/zend/platform/etc" on a linux machine
	 * @param string $...
	 * @return string
	 */
	static public function create() {
		if (0 == func_num_args()) {
			return '';
		}	
	
		$funcArgs = func_get_args();
		$path = rtrim(array_shift($funcArgs), '\\/');
		
		foreach ($funcArgs as $subPath) {
			$subPath = trim($subPath, '\\/');
			$path .= DIRECTORY_SEPARATOR . $subPath;
		}
		
		$path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
		return $path;
	}
}