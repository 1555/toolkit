<?php

class Zwas_Package {
	
	/**
	 * Define the compression level (0 - no compresion, 9 - most comressed)
	 * @var integer (0-9)
	 */
	const COMPRESSION_LEVEL = 9;
	
	/**
	 * @param mixed $data
	 * @return string - network transmission and binary safe
	 */
	public static function pack($data) {
		return convert_uuencode( gzcompress( serialize($data ), Zwas_Package::COMPRESSION_LEVEL ) );
		
	}
	
	/**
	 * @param string $data
	 * @return mixed
	 */
	public static function unpack($rawdata) {
		$compressed = @convert_uudecode( $rawdata );
		if (false === $compressed) {
			throw new Zwas_Exception(Zwas_Translate::_('Unable to unpack (decode) data'));
		}
		
		$serialized = @gzuncompress( $compressed );
		if (false === $serialized) {
			throw new Zwas_Exception(Zwas_Translate::_('Unable to unpack (uncompress) data'));
		}
		
		$data = @unserialize( $serialized );
		if ((false === $data) && ('b:0;' != $serialized)) { // success unserialize + the data value is not FALSE
			throw new Zwas_Exception(Zwas_Translate::_('Unable to unpack (serialize) data'));
		}
		
		return $data;
	}
}