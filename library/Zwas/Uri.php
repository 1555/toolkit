<?php

class Zwas_Uri {
	
	/**
	 * This class handle URIs with no url encoding (e.g. url from the monitor component)
	 */
	
	/**
	 * @see Zend_Uri::factory
	 * @param string $uri
	 * @return Zend_Uri
	 */
	public static function factory($uri) {
		return Zend_Uri::factory( self::encode($uri) );
	}
	
	/**
	 * Url encode URI
	 *
	 * @param string $uri
	 * @return string
	 */
	public static function encode($uri) {
		// TODO: replace this hack with real url encoding (raw url encode)
		return str_replace(' ', '%20', $uri);
	}
}