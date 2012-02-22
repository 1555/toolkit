<?php


require_once ('Zend/Dojo/Form.php');

class Newsletters_Forms_NewsletterEdit extends Zend_Dojo_Form
{
    
	protected $paras;
		 
		public function setParas($paras){
			//$this->paras = array_reverse($paras);
			$this->paras = $paras;
		}
	
	
	public function _init()
    {
		
		 $paras = new Zend_Form_SubForm(); // all the guests
  $parray = $this->paras;
//   var_dump(count($this->guests_array)); 
 // foreach($this->guests_array as $g){
 $i= 0;
 foreach( $parray as $p){
 // var_dump($p);
   $para = new Zend_Form_SubForm(); // all elemnets for a guest
   
   $para->addElement('text','h2', array('value'=>stripslashes($p['h2']),'size'=>'30'));
   $para->addElement('text','p', array('value'=>stripslashes($p['p']),'size'=>'90'));
   $para->addElement('text','link', array('value'=>stripslashes($p['link']),'size'=>'90',));
   $para->addElement('text','linktext', array('value'=>stripslashes($p['link_text']),'size'=>'30',));
// $para->addElement('button', 'add', array('size'   => 5,'label'  => '-','ignore' => true,'attribs' => array('onclick'=> "removeAnswer('$i')"),));
  // <input type="button" value="-" onClick="removeAnswer('+num+')">
 
  $para->h2->removeDecorator('DtDdWrapper');
   $para->h2->removeDecorator('HtmlTag');
   $para->h2->removeDecorator('Label');
   $para->p->removeDecorator('DtDdWrapper');
   $para->p->removeDecorator('HtmlTag');
   $para->p->removeDecorator('Label');
   $para->link->removeDecorator('DtDdWrapper');
   $para->link->removeDecorator('HtmlTag');
   $para->link->removeDecorator('Label');
   $para->linktext->removeDecorator('DtDdWrapper');
   $para->linktext->removeDecorator('HtmlTag');
   $para->linktext->removeDecorator('Label');
   // $para->add->removeDecorator('HtmlTag');
 //  $para->add->removeDecorator('Label');
   

   $paras->addSubForm($para, 'para'.$i);	
 $para->setElementsBelongTo('para'.$i);
$para->setLegend("Paragraph");
$i++;
  }
    	
  
 

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
          	'value' => $i,
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
        
      
        
        
        
		
		$paras->setLegend("Paragraphs");
	$this->addSubForm($paras, 'parasubs');	

		
		$this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Paragraph',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "newsletters.addParagraph()"),
        ));
        
    
        
		
		

		
        $this->addElement('Button', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update',
            'ignore' => true,
       'onclick'=> "newsletters.submit()",
        ));
        
       
        

    }
    
  
}
