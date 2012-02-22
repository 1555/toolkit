<?php


require_once ('Zend/Dojo/Form.php');

class Campaigns_Forms_ImageEdit extends Zend_Form
{
    
	
	

	
	
	
	public function init()
    {
    	
    Zend_Dojo::enableForm($this); 

   $this->setAttrib('enctype', 'multipart/form-data');
   $subform1 = new Zend_Dojo_Form_SubForm();
   $subform1->addElement('hidden', 'placeholder', array(
          	'value' => 0,
       		'name' => 'placeholder',
         'required'     =>false,
       ));
	   
	   
	$this->addElement('hidden', 'imageid');
	
        
        $this->addElement('text', 'title', array(
            'label'     => 'Image Title',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
         'readonly' => true,
            'filters'   => array(
                'StringTrim',
            ),
            'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
        ));
        
        $this->addElement('text', 'description', array(
            'label'     => 'Image Description',
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
        
        $this->addElement('text', 'alt', array(
            'label'     => 'Image Alt',
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
        
     
   
        
        
        $this->addElement('submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update Image',
            'ignore' => true,
       		 //'onclick'=> "validateForm()",
        ));
        
       //   $this->render();
    }
    
  
}
