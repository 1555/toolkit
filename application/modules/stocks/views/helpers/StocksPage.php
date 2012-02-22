<?php
class Zend_View_Helper_StocksPage extends Zend_View_Helper_Abstract
{
    public function StocksPage()
    {
       $urlHome = $this->view->urlHome; 
	  
	    $this->view->id = '';
        $this->view->name = '';
        $this->view->hot = '';
        $this->view->usedisplayname  = '';
		$this->view->stockindex  = '';
		
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newStock) {
            return $this->view->render('index/_newStock.phtml');
        }

       $stock = $this->view->stock;
		
		
		//var_dump($screen);
		
		
		
		if ($stock) {    
            // If a valid listing is found, assign additional view variables
          //  var_dump($stock);
            //$this->view->ScreenID = $screen[0]->ScreenID;
            //$this->view->Name = $this->view->escape(stripslashes($screen[0]->Name));
            $this->view->id = $this->view->escape(stripslashes($poll[0]->id));
	        $this->view->name = $this->view->escape(stripslashes($poll[0]->name));
	        $this->view->symbol = $this->view->escape(stripslashes($poll[0]->symbol));
	        $this->view->hot  = $this->view->escape(stripslashes($poll[0]->hot));
			$this->view->stockindex  = $this->view->escape(stripslashes($poll[0]->stockindex));
			$this->view->usedisplayname  = $this->view->escape(stripslashes($poll[0]->usedisplayname));
			
			
        }

        if ($this->view->editStock) {
            // Show the edit listing form
		//	echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editStock.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_stock.phtml');
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
