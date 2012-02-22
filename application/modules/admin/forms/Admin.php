<?php


require_once ('Zend/Dojo/Form.php');

class Admin_Forms_Admin extends Zend_Form
{
    
	
	
	public function init(){
    
    	
   Zend_Dojo::enableForm($this); 
   
   
   $this->addElement('text', 'firstname', array(
            'label'     => 'First Name',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
        ));
        
        $this->addElement('text', 'lastname', array(
            'label'     => 'Last Name',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
        ));
        
        $this->addElement('text', 'lastname', array(
            'label'     => 'Last Name',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
        ));
        
        $this->addElement('text', 'sso', array(
            'label'     => 'SSO Number',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
        ));
        
        
        
        $this->addElement('text', 'email', array(
            'label'     => 'Email Address',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum','Email',
            ),
        ));
        
       $this->addElement('select','role', array('label' => 'Users Role','multioptions'=>array('guests'=>'Guest','users'=>'User','marketing'=>'Marketing','editors'=>'Editors','alert'=>'Alert','admins'=>'Admin')));

   $this->addElement('Submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update Details',
            'ignore' => true,
       
        ));
   	
	}
    
  
}
