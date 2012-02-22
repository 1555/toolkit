<?php


require_once ('Zend/Dojo/Form.php');

class Alerts_Forms_AlertEdit extends Zend_Dojo_Form
{
    
	public $campaigns;
	public $guests_array;
	public $promos;
	
	public function setCampaigns($camps){ //
		//echo "bang";
		$this->campaigns = $camps;
		
		$this->addElement('DateTextBox', 'date', array(
	'required'     => true,
	'label'        => 'Alert Date *** Defaults to todays date ***',
	'formatLength' => 'short',
	'locale'       => 'en',
	'value' => '',
	'dojoType'=> 'dijit.form.DateTextBox',
	//'validators' => array(
               // array('StringLength', true, array(0, 300)),
               // 'Alnum',
            //),
	));
	//	var_dump($this->campaigns);
		 
		$this->addElement('select','banner_a_campaign_id', array('label' => 'Banner a campaign', 'multioptions'=>$this->campaigns));
		$this->addElement('select','banner_b_campaign_id', array('label' => 'Banner b campaign', 'multioptions'=>$this->campaigns));
		$this->addDisplayGroup(array('banner_a_campaign_id','banner_b_campaign_id'), 'banners', array("legend" => "Campaigns"));
	}
	
	public function setGuests($guests){ //
		//echo "bang";
		$this->guests_array = $guests;
	//	var_dump($this->campaigns);
		 
		
	}
	
public function setPromos($promos){
	//var_dump($promos);
		$this->promos = $promos;
		$this->addElement('select','promo_select', array('label' => 'Banner a campaign', 'multioptions'=>$this->promos,
		'attribs' => array(
        	'onchange'=> "alerts.injectPromo()"),
      ));
	
	$this->addDisplayGroup(array('promo_select'), 'promoss', array("legend" => "Promos"));
	}
	
	public function _init()
    {
    	
  // Zend_Dojo::enableForm($this); 

   
   	

   
  	
   
	/*$this->addElement('DateTextBox', 'date', array(
	'required'     => true,
	'label'        => 'Alert Date',
	'formatLength' => 'short',
	'locale'       => 'en',
	//'dojoType'=> 'dijit.form.DateTextBox',
	'validators' => array(
                array('StringLength', true, array(0, 300)),
                'Alnum',
            ),
	));*/
	
	

 		
 	//Zend_Dojo::enableForm($this); 
  $guests = new Zend_Form_SubForm(); // all the guests
  $garray = $this->guests_array;
//   var_dump(count($this->guests_array)); 
 // foreach($this->guests_array as $g){
 $i= 0;
 foreach($garray as $g){
 // var_dump($g);
   $guest = new Zend_Form_SubForm(); // all elemnets for a guest
   $guest->addElement('select','show_id', array('multioptions'=>array('Capital Connection','Squawk Box Europe','Worldwide Exchange','Strictly Money','European Closing Bell','Europe This Week','The Tonight Show with Jay Leno','11pm slot'),'value'=>($g['show_id'])-1));
   $guest->addElement('select','hrs', array('multioptions'=>array('05','06','07','08','09','10','11','12','13','14','16','17','18','19','20','21','22','23','24'),'value'=>($g['hrs'])-4));
   $guest->addElement('select','mins', array('multioptions'=>array('05','10','15','20','25','30','35','40','45','50','55','00'),));
   $guest->addElement('text','guestname', array('value'=>$g['guestname'],'size'=>'15'));
   $guest->addElement('text','guesttitle', array('value'=>$g['guesttitle'],'size'=>'15'));
   $guest->addElement('text','companyname', array('value'=>$g['companyname'],'size'=>'15',));
    $guest->addElement('text','topic', array('value'=>$g['topic'],'size'=>'15',));
   $guest->addElement('text','description', array('value'=>$g['description'],'cols'=>'95','rows'=>'3',));
  $guest->show_id->removeDecorator('DtDdWrapper');
   $guest->show_id->removeDecorator('HtmlTag');
   $guest->show_id->removeDecorator('Label');
   $guest->hrs->removeDecorator('DtDdWrapper');
   $guest->hrs->removeDecorator('HtmlTag');
   $guest->hrs->removeDecorator('Label');
   $guest->mins->removeDecorator('DtDdWrapper');
   $guest->mins->removeDecorator('HtmlTag');
   $guest->mins->removeDecorator('Label');
   $guest->guestname->removeDecorator('DtDdWrapper');
   $guest->guestname->removeDecorator('HtmlTag');
   $guest->guestname->removeDecorator('Label');
   $guest->guesttitle->removeDecorator('DtDdWrapper');
   $guest->guesttitle->removeDecorator('HtmlTag');
   $guest->guesttitle->removeDecorator('Label');
   $guest->companyname->removeDecorator('DtDdWrapper');
   $guest->companyname->removeDecorator('HtmlTag');
   $guest->companyname->removeDecorator('Label');
   $guest->topic->removeDecorator('DtDdWrapper');
   $guest->topic->removeDecorator('HtmlTag');
   $guest->topic->removeDecorator('Label');
   $guest->description->removeDecorator('DtDdWrapper');
   $guest->description->removeDecorator('HtmlTag');
   $guest->description->removeDecorator('Label');
  /*
  
  // $guest->setElementsBelongTo('guests[guest]');
  */
   $guests->addSubForm($guest, 'guest'.$i);	
  $guest->setElementsBelongTo('guest'.$i);
 $guest->setLegend("Guest");
$i++;
  }
 
    $this->addElement('hidden', 'shownum', array(
          	'value' => $i,
       		'name' => 'theValue',
        'required'     =>false,
            
        ));
        
        $this->addElement('hidden', 'promonum', array(
          	'value' => 0,
       		'name' => 'promoValue',
        'required'     =>false,
            
        ));

 $guests->setLegend("Guests");
	$this->addSubForm($guests, 'showssubs');	
        
        
     
        
        $this->addElement('button', 'add', array(
            'size'   => 100,
            'label'  => 'Add Show',
            'ignore' => true,
        'attribs' => array(
        	'onclick'=> "addShow('1')"),
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
        
        
        $this->addElement('Editor','promoBod',
        
        array(
        //'label'=>'Promo Body',
        'plugins' => array('bold', 'italic', 'underline', 'createLink', 'insertImage','foreColor', 'hiliteColor','undo','redo','cut','copy','paste','insertOrderedList','insertUnorderedList','LinkDialog','FullScreen','ViewSource','fontName','fontSize','formatBlock'),
        'dojoType'	=> 'dijit.Editor',
        //"style='display:none'" => 'none',
        
        )
        
        
        
        );
        
        
        
	
		 $this->addDisplayGroup(array('promotitle','type_id','promoBod'), 'promo', array("legend" => "Promo Info"));
        
		
		


		
        $this->addElement('submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update',
            'ignore' => true,
       'onclick'=> "alerts.submit()",
        ));
        
       //   $this->render();
    }
    
    
    
  
}
