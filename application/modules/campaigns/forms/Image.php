<?php


require_once ('Zend/Dojo/Form.php');

class Campaigns_Forms_Image extends Zend_Form
{
    
	public $companies;
	

	public function setCompanies($comps){ //
		
//var_dump("set companies called");
	//var_dump($comps);
		$this->companies = $comps;
		
		
	}
	
	
	public function _init()
    {
    	
    Zend_Dojo::enableForm($this); 

   $this->setAttrib('enctype', 'multipart/form-data');
   $subform1 = new Zend_Dojo_Form_SubForm();
   $subform1->addElement('hidden', 'placeholder', array(
          	'value' => 0,
       		'name' => 'placeholder',
         'required'     =>false,
       ));
	   
	 if(isset($this->companies)){ $this->addElement('select','company_id', array('label' => 'Company', 'multioptions'=>$this->companies));};
		
	
	$subform1->addDisplayGroup(array('placeholder'), 'images', array("legend" => "Images"));
  $this->addSubForm($subform1, 'imagesubs');   
 $this->addElement('hidden', 'shownum', array(
          	'value' => 0,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
		
		
        
		
     
   $this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Image',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "addImage('1')"),
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
