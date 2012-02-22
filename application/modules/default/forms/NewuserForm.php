<?php
class Form_NewuserForm extends Zend_Form 
{
    public function __construct($option = null) {
        parent::__construct($option);
        
        $this->setName('newuser');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User name:')
                 ->setRequired();
                 
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                 ->setRequired(true);
				 
		$email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
                 ->setRequired();
				 
	    $department = new Zend_Form_Element_Select('department');
		$department->setLabel('Department:')
         ->setRequired(true);
$myArray = array( 'NULL' => 'Select Department',
                     'marketing' => 'Marketing',
                     'news' => 'News',
                     'operations' => 'Operations'
                 );
				 
$department->addMultiOptions( $myArray );

$comments = new Zend_Form_Element_Textarea('comments');
$comments->setLabel('Comments:')
                 ->setRequired();
$comments->setAttrib('cols', '40');
$comments->setAttrib('rows', '4');


                 
        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Request');
        
        $this->addElements(array($username, $password, $email, $department, $comments, $login, ));
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/newuser');
    }
}
