<?php


require_once ('Zend/Dojo/Form.php');

class Alerts_Forms_Alert extends Zend_Dojo_Form
{
    
	public $campaigns;
	public $promos;
	public $prefix;
	
	public function setPrefix($prefix){
		//var_dump($prefix);
		$this->prefix = $prefix;
		//$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		
	}
	
	
	
	public function setCampaigns($camps){ //
		//echo "bang";
		$this->campaigns = $camps;
		
	
		$this->addElement('DateTextBox', 'date', array(
	'required'     => true,
	'label'        => 'Alert Date *** Defaults to todays date ***',
	'formatLength' => 'short',
	'locale'       => 'en', // so that it works with the gurst traker
	'value' => 'now',
	'dojoType'=> 'dijit.form.DateTextBox',
	//'validators' => array(
               // array('StringLength', true, array(0, 300)),
               // 'Alnum',
            //),
	));
		 
		$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		$this->addElement('select','banner_b_campaign_id', array('label' => 'Banner b campaign', 'multioptions'=>$this->campaigns));
		$this->addDisplayGroup(array('banner_a_campaign_id','banner_b_campaign_id'), 'banners', array("legend" => "Campaigns"));
	}
	
	public function setPromos($promos){
		$this->promos = $promos;
		$this->addElement('select','promo_select', array('label' => 'Choose an existing promo', 'multioptions'=>$this->promos,
		'attribs' => array(
        	'onchange'=> "alerts.injectPromo()"),
        ));
	
		$this->addDisplayGroup(array('promo_select'), 'promoss', array("legend" => "Promos"));
	}
	
	public function _init()
    {
    	
   //Zend_Dojo::enableForm($this); 

    $this->setAttrib('enctype', 'multipart/form-data');
    
    //  $this->setAttrib('widgetid', 'campaign');
   	
  
   
  	
   
	
	
	


      
     $guests = new Zend_Form_SubForm(); // all the guests
      $guests->setLegend("Guests - EITHER ADD MANUALLY OR POPULATE - NOT BOTH");
	$this->addSubForm($guests, 'showssubs');	 
		
	
	//$subform1->addDisplayGroup(array('placeholder'), 'showssubs', array("legend" => "The Guests"));
        
   
     	
     	
     	
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
        
        $this->addElement('hidden', 'promonum', array(
          	'value' => 0,
       		'name' => 'promoValue',
        'required'     =>false,
            
        ));
		
		
     
	 $this->addElement('button', 'populate', array(
            'size'   => 100,
            'label'  => 'Populate from Guest Tracker',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "alerts.populateShows('".APPLICATION_SUBDOMAIN."')"),
        ));
       
        $this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Show',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "alerts.addShow('1','0','')"),
        ));
        
        $this->addElement('button', 'addP', array(
            'size'   => 100,
            'label'  => 'Create new Promo',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "alerts.addPromo('1')"),
        ));
        
        $this->addElement('text', 'promotitle', array(
            'label'     => 'Promo Title (name given to promo in the database)',
            'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
            //'validators' => array(
              //  array('StringLength', true, array(0, 300)),
               // 'Alnum',
           // ),
        ));
        
        
$type_id = new Zend_Form_Element_Radio('type_id');
    $type_id->setLabel('Please Choose')
            ->setRequired()
            ->setMultiOptions(array('updatep' => "Update original promo", 'addp' => 'Add promo to library'));

    
            
            $this->addElement($type_id);
            
            $type_id->removeDecorator('DtDdWrapper');
            $type_id->removeDecorator('HtmlTag');
            $type_id->removeDecorator('Label');
      
       /* $this->addElement('text', 'promolink', array(
            'label'     => 'Promo Link',
            'class'     => 'genText',
            'size'      => 52,
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
          //  'validators' => array(
              //  array('StringLength', true, array(0, 300)),
               // 'Alnum',
           // ),
        ));*/
        
        
        $this->addElement('Editor','promoBod',
        
        array(
        //'label'=>'Promo Body',
        'plugins' => array('bold', 'italic', 'underline', 'createLink', 'insertImage','foreColor', 'hiliteColor','undo','redo','cut','copy','paste','insertOrderedList','insertUnorderedList','LinkDialog','FullScreen','ViewSource','fontName','fontSize','formatBlock'),
        'dojoType'	=> 'dijit.Editor',
        //"style='display:none'" => 'none',
        
        )
        
        
        
        );
        
          
        
        
       /* $this->addElement('text', 'promocopy', array(
            'label'     => 'Promo Copy',
            'class'     => 'genText',
            'cols'      => 40,
         	'rows'      => 5,
            //'maxlength' => 15,
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
           // 'validators' => array(
              //  array('StringLength', true, array(0, 300)),
               // 'Alnum',
            //),
        ));*/
        
        
        
        
        
        
	
		 $this->addDisplayGroup(array('promotitle','type_id', 'promoBod'), 'promo', array("legend" => "Promo Info"));
        
		
		

		
        $this->addElement('Button', 'Submit', array(
            'size'   => 100,
            'label'  => 'Create',
            'ignore' => true,
       'onclick'=> "alerts.submit()",
        ));
		
		/*$this->addElement('Button', 'Preview', array(
            'size'   => 100,
            'label'  => 'Preview',
            'ignore' => true,
       'onClick'=> "location.href='/public/alerts/index/preview/?keepThis=true&TB_iframe=true&height=900&width=595', location.class='thickbox'",
        ));*/
        
       
        

    }
    
  
}
