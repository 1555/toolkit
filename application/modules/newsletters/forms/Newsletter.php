<?php


require_once ('Zend/Dojo/Form.php');

class Newsletters_Forms_Newsletter extends Zend_Dojo_Form
{
    
	
		 
		
	
	
	public function init()
    {
    	
   //Zend_Dojo::enableForm($this); 

    $this->setAttrib('enctype', 'multipart/form-data');
    
        
   
     	
     	
     	
        $this->setDecorators(array(
        'FormElements',
        array('HtmlTag', array('tag'=>'ol', 'id'=>'showslist')),
       
        'Form'
        ));
		
		$this->addElement('DateTextBox', 'date', array(
	'required'     => true,
	'label'        => 'Newletter Date *** Defaults to todays date ***',
	'formatLength' => 'short',
	'locale'       => 'en', // so that it works with the gurst traker
	'value' => 'now',
	'dojoType'=> 'dijit.form.DateTextBox',
	//'validators' => array(
               // array('StringLength', true, array(0, 300)),
               // 'Alnum',
            //),
	));
       
        
        $this->addElement('hidden', 'paranum', array(
          	'value' => 0,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
        
      
       
        
        
        
        $this->addElement('text', 'newsletterTitle', array(
            'label'     => 'Newsletter Title (somthing catchy please)',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
			));
			
			$this->addElement('text', 'newsletterBody', array(
            'label'     => 'Newsletter Body (key points)',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
			));
        
      
        
        
        
		
		$paragraphs = new Zend_Form_SubForm(); // all the guests
      $paragraphs->setLegend("Paragraphs");
	$this->addSubForm($paragraphs, 'parasubs');	
		
		$this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Paragraph',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "newsletters.addParagraph()"),
        ));
        
    
        
		
		

		
        $this->addElement('Button', 'Submit', array(
            'size'   => 100,
            'label'  => 'Create',
            'ignore' => true,
       'onclick'=> "newsletters.submit()",
        ));
        
       
        

    }
    
  
}
