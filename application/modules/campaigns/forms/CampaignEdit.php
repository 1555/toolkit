<?php


require_once ('Zend/Dojo/Form.php');
//require_once APPLICATION_PATH . '/modules/Campaigns/forms/element/plainText.php';

class Campaigns_Forms_CampaignEdit extends Zend_Form
{
    
	public $campaigns;
	//public $companies;
	public $images;
	//public $campId;
	
	/*public function setCampaigns($camps){ //
		//echo "bang";
		$this->campaigns = $camps;
		var_dump($this->campaigns);
		 
		$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		$this->addElement('select','banner_b_campaign_id', array('label' => 'Banner b campaign', 'multioptions'=>$this->campaigns));
		$this->addDisplayGroup(array('banner_a_campaign_id','banner_b_campaign_id'), 'banners', array("legend" => "Campaigns"));
	}*/
	
public function setCompanies($comps){ //
		//var_dump("set companies called");
		//echo $comps;
		$this->companies = $comps;
		
	//	$this->addElement('select','company_id', array('label' => 'Company', 'multioptions'=>$this->companies));
		//$this->addElement('select','image_id', array('label' => 'Company', 'multioptions'=>$this->companies));
		//$this->addDisplayGroup(array('company_id'), 'banners', array("legend" => "Campaigns"));
		
	}
	
public function setCompany($id){
		
		$this->addElement('hidden', 'placeholder', array(
          	'value' => $id,
       		'name' => 'company_id',
         'required'     =>false,
       )); 
	}
	
	
public function setImages($images){ //
		//var_dump($images);
		//echo $comps;
		$this->images = $images;
		$this->addElement('select','banner_id', array('label' => 'Alert Banner', 'multioptions'=>$this->images,
		'attribs' => array(
        	'onchange'=> "catchSpinnerchange('banner')"),
        ));
		$this->addElement('select','skyscraper_id', array('label' => 'Alert Skyscaper', 'multioptions'=>$this->images,
		'attribs' => array(
        	'onchange'=> "catchSpinnerchange('skyscraper')"),
        ));
	
		//$this->addDisplayGroup(array('company_id'), 'banners', array("legend" => "Campaigns"));
		
	}
	
	public function _init()
    {
   $id = $this->getAttrib('campaign');
   $campaignMod = 	new Campaigns_Model_DbTable_Campaigns();
   $images = $campaignMod->getAllImageForACampaign($id);
  // var_dump($this->getRequest()); //'campaign'
  // var_dump($images);
    	
   Zend_Dojo::enableForm($this); 

   $this->setAttrib('enctype', 'multipart/form-data');
   
   	
  
   
  	
   
	$this->addElement('DateTextBox', 'startdate', array(
	'required'     => true,
	'label'        => 'Start Date',
	'formatLength' => 'short',
	'locale'       => 'en',
	'dojoType'=> 'dijit.form.DateTextBox',
	'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
	));
	
	$this->addElement('DateTextBox', 'enddate', array(
	'required'     => true,
	'label'        => 'End Date',
	'formatLength' => 'short',
	'locale'       => 'en',
	'dojoType'=> 'dijit.form.DateTextBox',
	'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
	));
	
	


      

   // $subform1->addDisplayGroup($subs, 'images', array("legend" => "Images")); 	
      //  $this->setDecorators(array(
     //   'FormElements',
     //   array('HtmlTag', array('tag'=>'ol', 'id'=>'showslist')),
     //  
       // 'Form'
      //  ));
        
    //  $group = new Zend_Form_Element_Text('group');
      //$this->
      // $group->setLabel('Shows');
         
  
        
        
        // array('HtmlTag', array('tag'=>'input', 'id'=>'theValue','name'=>'shownum','value'=>'0','type'=>'hidden')),
        
        $this->addElement('hidden', 'shownum', array(
          	'value' => 0,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
        
        $this->addElement('hidden', 'company', array(
          	'value' => 10,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
        
   
     
        
        $this->addElement('text', 'title', array(
            'label'     => 'Campaign Title',
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
        
        
        $this->addElement('text', 'description', array(
            'label'     => 'Description',
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
        
        $this->addElement('text', 'clickthroughurl', array(
            'label'     => 'Click through URL (Banner)',
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
		
		$this->addElement('text', 'clickthroughurl_B', array(
            'label'     => 'Click through URL (Skyscapper)',
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
        
       
        
        
        
        
        
            $subform1 = new Zend_Dojo_Form_SubForm();
       // $subs = array();
        $this->addSubForm($subform1, 'imagesubs'); 
        
			$subform1->addElement('hidden', 'placeholder', array(
          	'value' => 0,
       		'name' => 'placeholder',
         	'required'     =>false,
       ));
       $is = array(); 
       $is[] = 'placeholder';
       if(count($images) > 0){
       
     $n = 0;
     
      foreach($images as $image){
      	
      	$subform = new Zend_Dojo_Form_SubForm();
      	
      	//$subform1 = new Zend_Dojo_Form_SubForm();
     //  var_dump($image);
       /*$subform->addElement('text', 'name', array(
          	'value' => $image['image_name'],
       'label' => 'Image Name',
       		'name' => 'name',
       'size'=>'100',
         'required'     =>false,
       'readonly' => true,
       ));*/
       
       $subform->addElement('text', 'alt', array(
          	'value' => $image['alt'],
       'label' => 'Alt attribute',
       		'name' => 'alt',
       'size'=>'100',
         'required'     =>false,
       
       ));
       
      
       $subform->addElement('text', 'desc', array(
          	'value' => $image['description'],
       'label' => 'Image description',
       		'name' => 'desc',
       'size'=>'100',
         'required'     =>false,
   
       ));
       
       $subform->addElement('texts', 'name', array(
          	'value' => $image['image_name'],
       'label' => 'Image Name',
       		'name' => 'name',
       'size'=>'100',
         'required'     =>false,
        'readonly' => true,
   
       ));
       
       
       
       /*$subform->addElement('radio', 'alertbanner', array(
        'label' => 'Select an option below',
       'name'=>'alertbanner',
        'multiOptions' => array(
            'val1'  => 'Alert Banner',
        )
       ));*/
       
       
       $subform->addElement('hidden', 'id', array(
          	'value' => $image['id'],
       		'name' => 'id',
       		'size'=>'100',
        	 'required'     =>false,
   
       ));
       
     	array_push($is, 'name');
		array_push($is, 'desc');
		array_push($is, 'alt');
		array_push($is, 'id');
		array_push($is, 'alertbanner');
		$subform->addDisplayGroup($is, 'image'.$n, array("legend" => $image['image_name']));  
		$this->imagesubs->addSubForm($subform, $n); 
		//array_push($subs, 'image'.$n);
       $val = $this->getElement('shownum');
		
		$val->setValue($n);
		$n++;
       }
       

    	
       
    
	
	
            
   
       }
        
        
        
        
        
        
	
		// $subform1->addDisplayGroup(array('placeholder'), 'images', array("legend" => "New Images"));
        
		// $this->addSubForm($subform1, 'imagesubs');   
		
		/*$this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Image',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "addImage('1')"),
			
			
        ));*/
		
		$this->addElement('checkbox', 'useforalerts', array(
            'label'     => 'Use in Alerts?',
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
		
		$this->addElement('checkbox', 'usefornewsletter', array(
            'label'     => 'Use in News letters?',
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
            'label'  => 'Update Campaign',
            'ignore' => true,
        ));
        
       //   $this->render();
    }
    
  
}
