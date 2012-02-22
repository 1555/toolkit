<?php

class Zwas_Translate {
	
	/**
     * Translates the given string
     * returns the translation
     *
     * @param  string              $messageId  Translation string
     * @param  string|Zend_Locale  $locale     OPTIONAL Locale/Language to use, identical with locale identifier,
     *                                         see Zend_Locale for more information
     * @return string
     */
    public static function _($messageId, $locale = null) {
    	return $messageId;
    }
}
