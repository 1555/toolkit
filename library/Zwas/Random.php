<?php
/**
 * A pseudorandom number generator (PRNG), uniqueness and sequencing services
 */
class Zwas_Random implements Zwas_Random_FactoryInterface {
	
	/**
	 * @var Zwas_Random_FactoryInterface
	 */
	protected static $factory;
	
	public static function uniqId() {
		return self::getInstance()->uniqId();
	}
	
	public static function randomPassword() {
		return self::getInstance()->randomPassword();
	}
	
	/**
	 * @return Zwas_Random_FactoryInterface
	 */
	public static function getInstance() {
		if (is_null(self::$factory)) {
			self::$factory = new Zwas_Random_Factory();
		}
		return self::$factory;
	}
	
	/**
	 * @param Zwas_Random_FactoryInterface $instance
	 */
	public static function setInstance(Zwas_Random_FactoryInterface $instance) {
		self::$factory = $instance;
	}
	
    /**
     * Resets all object properties of the singleton instance
     * @return void
     */
    public static function resetInstance() {
    	self::$factory = null;
    }
}