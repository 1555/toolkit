<?php
class Zend_View_Helper_AlertPage extends Zend_View_Helper_Abstract
{
    public function AlertPage()
    {
       $urlHome = $this->view->urlHome; 
	  
	    $this->view->id = '';
        $this->view->date = '';
     	$this->view->promotitle = '';
     	$this->view->promocopy  = '';
		$this->view->promoValue = '';
		$this->view->banner_b_campaign_id  = '';
		$this->view->banner_b_campaign_id = '';
		
		
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newAlert) {
            return $this->view->render('index/_newAlert.phtml');
        }

       $alert = $this->view->alert;
       $promo = $this->view->promo;
		
		
	//	var_dump($promo);
		
		
		
		if ($alert) {    
            // If a valid listing is found, assign additional view variables
          // var_dump($alert);
            //$this->view->ScreenID = $screen[0]->ScreenID;
            //$this->view->Name = $this->view->escape(stripslashes($screen[0]->Name));
            $this->view->id = $this->view->escape(stripslashes($alert['id']));
	        $this->view->date = $this->view->escape(stripslashes($alert['date']));
	        $this->view->promotitle = $this->view->escape(stripslashes($promo['title']));
	        $this->view->promocopy  = $this->view->escape(stripslashes($promo['content']));
		 	$this->view->promoValue  = $this->view->escape(stripslashes($promo['id']));
			$this->view->banner_b_campaign_id  = $this->view->escape(stripslashes($alert['banner_b_campaign_id']));
			$this->view->banner_a_campaign_id  = $this->view->escape(stripslashes($alert['banner_a_campaign_id']));
					//$this->view->promolink  = $this->view->escape(stripslashes($alert['promolink']));
			
			
        }

        if ($this->view->editAlert) {
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editAlert.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_alert.phtml');
        }

        if ($this->view->history) {
            // Show the edit history
            return $this->view->render('index/_history.phtml');
        }

        return '';
    }
	
	private function object_to_array($data) {
		
		  if(is_array($data) || is_object($data)) {
			$result = array(); 
			foreach($data as $key => $value)
			{ 
			  $result[$key] = $this->object_to_array($value); 
			}
			return $result;
		  }
		  return $data;
		}
}
