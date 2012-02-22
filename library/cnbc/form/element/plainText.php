<?php

class Campaigns_Forms_Element_Plaintext extends Zend_Form_Element_Xhtml {

    public $helper='PlainTextElement';

    public function isValid($value){

        return true;
    }
}