<?php
class Zend_View_Helper_PromoPage extends Zend_View_Helper_Abstract
{
    public function PromoPage()
    {
      // $urlHome = $this->view->urlHome; 
	  
	  
      $this->view->promotitle = '';
      $this->view->promocopy  = '';
		$this->view->promoimage = '';
		$this->view->promolink = '';
		$this->view->promoid = '';
		
		//echo 'in';
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newPromo) {
            return $this->view->render('index/_newPromo.phtml');
        }

      
       $promo = $this->view->promo;
		
		
	
	//var_dump($promo);
		
		
		if ($promo) {    
            // If a valid listing is found, assign additional view variables
  // echo 'jumpin';
            //$this->view->ScreenID = $screen[0]->ScreenID;
            //$this->view->Name = $this->view->escape(stripslashes($screen[0]->Name));
          
	        $this->view->promotitle = $this->view->escape(stripslashes($promo['title']));
			$this->view->promoid = $this->view->escape(stripslashes($promo['id']));
	        $this->view->promocopy  = $this->view->escape(stripslashes($promo['content']));
		 	$this->view->promoImage  = $this->view->escape(stripslashes($promo['imageid']));
			$this->view->promoLink  = $this->view->escape(stripslashes($promo['link']));
			$this->view->image_id = $this->view->escape(stripslashes($promo['image_id']));
		//echo($this->view->imageid);
					//$this->view->promolink  = $this->view->escape(stripslashes($alert['promolink']));
			
			
        }

        if ($this->view->editPromo) {
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		   return $this->view->render('index/_editPromo.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_promo.phtml');
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
