<?php
class Form_UsernameForm extends Zend_Form 
{
    public function __construct($option = null) {
        parent::__construct($option);
        
        $this->setName('login');
        
        $username = new Zend_Form_Element_Text('password');
        $username->setLabel('Password:')
                 ->setRequired();
                 
        $password = new Zend_Form_Element_Password('email');
        $password->setLabel('Email:')
                 ->setRequired(true);
                 
        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Login');
        
        $this->addElements(array($username, $password, $login));
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/default/authentication/fetchusername');
    }
}
