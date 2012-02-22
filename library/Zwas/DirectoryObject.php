<?php
class Zwas_DirectoryObject {
	
	/**
	 * @var string
	 */
	private $path;
	
	public function __construct($path) {
		$path = trim($path);
		if (empty($path)) {
			throw new Zwas_Exception(__CLASS__ . ' expects to get a path', Zwas_Exception::ASSERT);
		}
		clearstatcache();
		$this->path = $path;
	}
	
	/**
	 * Find pathnames matching a pattern added to the objects path
	 *
	 * @param string $pattern
	 * @param int $flags 
	 */
	public function getGlob($pattern, $flags = null) {
		$pattern = Zwas_Path::create($this->path, $pattern);
		return glob($pattern, $flags);
	}

	/**
	 * Tells whether the path is a directory
	 * @return boolean
	 */
	public function isDir() {
		return is_dir($this->path);
	}
	
	/**
	 * Return the directory's mtime timestamp
	 * @return integer
	 * @throws Zwas_Exception
	 */
	public function getMTime() {
		if ($this->isDir()) {
			$mtime = filemtime($this->path);
			if (false === $mtime) {
				throw new Zwas_Exception(new Zwas_Text(Zwas_Translate::_('Error getting the mtime for \'%s\''), array($this->path)));
			}
		} else {
			$mtime = 0;
		}
	
		return $mtime;
	}
}