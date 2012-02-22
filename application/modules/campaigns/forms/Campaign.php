<?php


require_once ('Zend/Dojo/Form.php');

class Campaigns_Forms_Campaign extends Zend_Dojo_Form
{
    
	public $campaigns;
	public $images;
	public $companies;
	public $id;
	
	/*public function setCampaigns($camps){ //
		//echo "bang";
		$this->campaigns = $camps;
		var_dump($this->campaigns);
		 
		$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		$this->addElement('select','banner_b_campaign_id', array('label' => 'Banner b campaign', 'multioptions'=>$this->campaigns));
		$this->addDisplayGroup(array('banner_a_campaign_id','banner_b_campaign_id'), 'banners', array("legend" => "Campaigns"));
	}*/
	
	public function setCompanies($comps){ //
		
	//	var_dump("set companies called");
		//echo $comps;
		$this->companies = $comps;
		$this->addElement('select','company_id', array('label' => 'Company', 'multioptions'=>$this->companies,
		'attribs' => array(
        	'onchange'=> "collectImages()")));
		//$this->addDisplayGroup(array('company_id'), 'banners', array("legend" => "company"));
		
	}
	
	public function setCompany($id){
		
		$this->id = $id;
		
		$this->addElement('hidden', 'placeholder', array(
          	'value' => $id,
       		'name' => 'company_id',
         'required'     =>false,
       )); 
	}
	
public function setImages($images){ //
		//svar_dump($images);
		//echo $comps;
		$this->images = $images;
		$this->addElement('select','banner_id', array('label' => 'Top Banner', 'multioptions'=>$this->images,
		'attribs' => array(
        	'onchange'=> "catchSpinnerchange('banner')"),
        ));
		$this->addElement('select','skyscraper_id', array('label' => 'Skyscrapper Banner', 'multioptions'=>$this->images,
		'attribs' => array(
        	'onchange'=> "catchSpinnerchange('skyscraper')"),
        ));
	
		//$this->addDisplayGroup(array('company_id'), 'banners', array("legend" => "Campaigns"));
		
	}
	
	
	
	public function _init()
    {
    	//$campaignMod = new Campaigns_Model_DbTable_Campaigns();
    	//var_dump("int called");
    
    Zend_Dojo::enableForm($this); 

   $this->setAttrib('enctype', 'multipart/form-data');
   
   	
  
   
  	
   
	$this->addElement('DateTextBox', 'startdate', array(
	'required'     => true,
	'label'        => 'Start Date',
	'formatLength' => 'long',
	'locale'       => 'en',
	'dojoType'=> 'dijit.form.DateTextBox',
	'onChange'=> "dijit.byId('enddate').constraints.min = arguments[0]",
	'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
	));
	
	$this->addElement('DateTextBox', 'enddate', array(
	'required'     => true,
	'label'        => 'End Date',
	'formatLength' => 'long',
	'locale'       => 'en',
	'dojoType'=> 'dijit.form.DateTextBox',
	'onChange'=> "dijit.byId('startdate').constraints.max = arguments[0]",
	'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
	));
	
	
$this->addElement('button', 'newimage', array(
            'size'   => 100,
            'label'  => 'Upload an Image for this campaign',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "imageForCampaign('$this->id')"),
        ));

      
       /* $subform1 = new Zend_Dojo_Form_SubForm();
        
$subform1->addElement('hidden', 'placeholder', array(
          	'value' => 0,
       		'name' => 'placeholder',
         'required'     =>false,
       ));
	
	$subform1->addDisplayGroup(array('placeholder'), 'images', array("legend" => "Images"));*/
        
    
     	
     	
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
        
      //  $this->addElement(company_id)
     
        
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
            'label'     => 'Click through URL (Skyscrapper)',
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
            'label'     => 'Use in News Letters?',
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
        
        
        
        
        
        
        
        
        
        
        
	
		// $this->addDisplayGroup(array('promotitle','promocopy','promolink'), 'promo', array("legend" => "Promo Info"));
        
		// $this->addSubForm($subform1, 'imagesubs');   
		
/*$this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Image',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "addImage('1')"),
        ));*/

		
        $this->addElement('button', 'Submit', array(
            'size'   => 100,
            'label'  => 'Create Campaign',
            'ignore' => true,
       		 'onclick'=> "validateForm()",
        ));
        
       //   $this->render();
    }
    
  
}
