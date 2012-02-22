<?php


require_once ('Zend/Dojo/Form.php');

class Newletterbody_Forms_Newsletters extends Zend_Dojo_Form
{
    

        
		
		public function init(){ //
		
		/*$this->addElement('textArea', 'shownum', array(
          	'value' => 0,
       		'name' => 'theValue',
        	'required'     =>false,
            
        ));*/

		
        $this->addElement('Button', 'Submit', array(
            'size'   => 100,
            'label'  => 'Create',
            'ignore' => true,
      		'onclick'=> "submit()",
        ));
        
       
        
		}

    
  
}
