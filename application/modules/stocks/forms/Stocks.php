<?php


require_once ('Zend/Dojo/Form.php');

class Stocks_Forms_Stocks extends Zend_Form
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
	
	$subform1->addDisplayGroup(array('placeholder'), 'stocks', array("legend" => "Stocks"));
  $this->addSubForm($subform1, 'stockssubs');   
 $this->addElement('hidden', 'shownum', array(
          	'value' => 0,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
        
     
   $this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Stock',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "addStock('1')"),
        ));
        
        
        
        $this->addElement('submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Upload Images',
            'ignore' => true,
       		 //'onclick'=> "validateForm()",
        ));
        
       //   $this->render();
    }
    
  
}
