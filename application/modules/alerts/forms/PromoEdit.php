<?php


require_once ('Zend/Dojo/Form.php');

class Alerts_Forms_PromoEdit extends Zend_Dojo_Form
{
    
	public function setImages($images){ // $images
		
		//var_dump($images);
		//echo $comps;
		/*$this->images = $images;*/
		
		$this->addElement('select','image_id', array('label' => 'Promo Image', 'multioptions'=>$images,
		'attribs' => array(
        	'onchange'=> "catchSpinnerchange('skyscraper')"),
        ));
	
		//$this->addDisplayGroup(array('company_id'), 'banners', array("legend" => "Campaigns"));*/
		
	}
	
	public function _init()
    {
    	


    $this->setAttrib('enctype', 'multipart/form-data');
    
  
     	
      	

	
     
        
       
       
       
        
       
        
        $this->addElement('text', 'promotitle', array(
            'label'     => 'Promo Title (name given to promo in the database)',
       //     'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
				'onkeydown'=>'limitText(this, 200, 50);',
            
        ));
		
		$this->addElement('Textarea', 'promocontent', array(
            'label'     => 'Promo Text (this will be a link)',
       //     'class'     => 'genText',
          'cols' => '100',
			'rows' => '20',
            // 'size'      => 52,
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
			'onkeydown' => "limitText(this, 200, 200);",
            
        ));
		
		$this->addElement('text', 'link', array(
            'label'     => 'Promo Link (usually a page within the cnbc.com site)',
       //     'class'     => 'genText',
            'size'      => 52,
            
            'required'  => true,
            'filters'   => array(
                'StringTrim',
            ),
			
            
        ));
        
        

		
        $this->addElement('submit', 'Submit', array(
            'size'   => 100,
            'label'  => 'Update',
            'ignore' => true,
       // 'onclick'=> "submit()",
        ));
        
       
        

    }
    
    
    
  
}
