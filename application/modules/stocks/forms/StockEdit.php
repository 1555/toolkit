<?php


require_once ('Zend/Dojo/Form.php');
//require_once APPLICATION_PATH . '/modules/Campaigns/forms/element/plainText.php';

class Stocks_Forms_StockEdit extends Zend_Form
{
    
	public $campaigns;
	public $images;
	
	/*public function setCampaigns($camps){ //
		//echo "bang";
		$this->campaigns = $camps;
		var_dump($this->campaigns);
		 
		$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		$this->addElement('select','banner_b_campaign_id', array('label' => 'Banner b campaign', 'multioptions'=>$this->campaigns));
		$this->addDisplayGroup(array('banner_a_campaign_id','banner_b_campaign_id'), 'banners', array("legend" => "Campaigns"));
	}*/
	
	public function setImages($images){
		
		$this->images = $images;
	}
	
	public function init()
    {
    	//$campaignMod = new Campaigns_Model_DbTable_Campaigns();
    	//var_dump($this->getAttribs());
    
   Zend_Dojo::enableForm($this); 

   $this->setAttrib('enctype', 'multipart/form-data');
   
   	
  
   
  	
   
	
	


      
        $subform1 = new Zend_Dojo_Form_SubForm();
        
$subform1->addElement('hidden', 'placeholder', array(
          	'value' => 0,
       		'name' => 'placeholder',
         'required'     =>false,
       ));
	
	$subform1->addDisplayGroup(array('placeholder'), 'images', array("legend" => "Images"));
        
    
     	
     	
        $this->setDecorators(array(
        'FormElements',
        array('HtmlTag', array('tag'=>'ol', 'id'=>'showslist')),
       
        'Form'
        ));
        
      $group = new Zend_Form_Element_Text('group');
      //$this->
      // $group->setLabel('Shows');
         
  
        
        
        // array('HtmlTag', array('tag'=>'input', 'id'=>'theValue','name'=>'shownum','value'=>'0','type'=>'hidden')),
        
        $this->addElement('hidden', 'shownum', array(
          	'value' => 0,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
     
        
        $this->addElement('text', 'title', array(
            'label'     => 'Company Name',
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
		$this->addElement('text', 'symbol', array(
            'label'     => 'Security Symbol',
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
		
		$this->addElement('checkbox', 'hot', array(
            'label'     => 'Hot Stock',
            'class'     => 'genText',
            'size'      => 52,
           
            
        ));
		
		$this->addElement('checkbox', 'displayname', array(
            'label'     => 'Use Display Name',
            'class'     => 'genText',
            'size'      => 52,
           
            
        ));

        
        
       
        
		 
        $this->addElement('submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update Stock',
            'ignore' => true,
       		 'onclick'=> "validateForm()",
        ));
        
       //   $this->render();
    }
    
  
}
  
