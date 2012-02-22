<?php
class Zend_View_Helper_CampaignsPage extends Zend_View_Helper_Abstract
{
    public function CampaignsPage()
    {
       $urlHome = $this->view->urlHome; 
	   //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
	    $this->view->id = '';
        $this->view->camptitle = '';
        $this->view->description = '';
        $this->view->startdate  = '';
		$this->view->enddate  = '';
		$this->view->clickthroughurl= '';
		$this->view->clickthroughurl_B= '';
		$this->view->company  = '';
		$this->view->modifiedbyid  = '';
		$this->view->useforalerts  = '';
		$this->view->usefornewsletter  = '';
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newCampaign) {
            return $this->view->render('index/_newCampaign.phtml');
        }

       $campaign = $this->view->campaign;
       $image = $this->view->image;
		
		
//	var_dump($campaign);
		
		
		
		if ($campaign) {    
            // If a valid listing is found, assign additional view variables
      //     var_dump($campaign);
            //$this->view->ScreenID = $screen[0]->ScreenID;
            //$this->view->Name = $this->view->escape(stripslashes($screen[0]->Name));
            $this->view->id = $this->view->escape(stripslashes($campaign['id']));
			$this->view->banner_id = $this->view->escape(stripslashes($campaign['banner_id']));
			$this->view->skyscraper = $this->view->escape(stripslashes($campaign['skyscraper']));
			$this->view->userid = $this->view->escape(stripslashes($campaign['modifiedbyid']));
	        $this->view->camptitle = $this->view->escape(stripslashes($campaign['title']));
	        $this->view->description = $this->view->escape(stripslashes($campaign['description']));
	        $this->view->startdate  = $this->view->escape(stripslashes($campaign['startdate']));
			$this->view->enddate  = $this->view->escape(stripslashes($campaign['enddate']));
			$this->view->clickthroughurl = $this->view->escape(stripslashes($campaign['clickthroughurl']));
			$this->view->clickthroughurl_B = $this->view->escape(stripslashes($campaign['clickthroughurl_B']));
			$this->view->company  = $this->view->escape(stripslashes($campaign['company']));
			$this->view->useforalerts  = $this->view->escape(stripslashes($campaign['useforalerts']));
			$this->view->usefornewsletter  = $this->view->escape(stripslashes($campaign['usefornewsletter']));
			
        }
        
    if ($image) {    
       $this->view->id = $this->view->escape(stripslashes($image['id']));
        $this->view->imagetitle = $this->view->escape(stripslashes($image['image_name']));
         $this->view->description = $this->view->escape(stripslashes($image['description']));
         $this->view->alt = $this->view->escape(stripslashes($image['alt']));  
			
   }
        
     

        if ($this->view->editCampaign){
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editCampaign.phtml');
        }
        
    if ($this->view->editImage){
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editImage.phtml');
        }
        
   		 if ($this->view->editCompany) {
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/editcompany.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_campaign.phtml');
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
