<?php
class Zwas_Random_Factory implements Zwas_Random_FactoryInterface {
	public static function uniqId() {
		return uniqid(getmypid());
	}
	
	public static function randomPassword() {
		return substr(base64_encode(Zend_Crypt::hash('sha1', mt_rand(100000000, 999999999),true)), 0, -1);
	}
}