<?php

/**
 * Zwas exception
 */
class Zwas_Exception extends Zend_Exception {
	
	const ASSERT	= 1;
	const WARNING	= 2;
	const ERROR		= 4;
	
	/**
	 * @var Zwas_Text
	 */
	protected $messageObj;

	/**
	 * Zwas exception accepts either a string or a Zwas_Text object as the $message
	 *
	 * @param Zwas_Text|string $message
	 * @param int $code
	 */
	public function __construct($message, $code = Zwas_Exception::ERROR) {
		if ($message instanceof Zwas_Text) {
			$this->messageObj = $message;
		} else {
			// Zwas_text message without arguments
			$this->messageObj = new Zwas_Text($message);
		}
		
		parent::__construct($this->messageObj->getMessage(), $code);
	}
	
	/**
	 * @return Zwas_Text
	 */
	public function getMessageObject() {
		return $this->messageObj;
	}
}