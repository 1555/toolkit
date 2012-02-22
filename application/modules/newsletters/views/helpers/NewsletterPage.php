<?php
class Zend_View_Helper_NewsletterPage extends Zend_View_Helper_Abstract
{
    public function NewsletterPage()
    {
       $urlHome = $this->view->urlHome; 
	  
	    $this->view->id = '';
        $this->view->date = '';
      	$this->view->newsletterTitle = '';
   		$this->view->newsletterBody  = '';
		$this->view->banner_b_campaign_id  = '';
		
		
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newNewsletter) {
            return $this->view->render('index/_newNewsletter.phtml');
        }

       $newsletter = $this->view->newsletter;
      
		if ($newsletter) {    
           // echo "there an nl";
            $this->view->id = $this->view->escape(stripslashes($newsletter[0]['id']));
	        $this->view->date = $this->view->escape(stripslashes($newsletter[0]['date']));
	        $this->view->newsletterTitle = $this->view->escape(stripslashes($newsletter[0]['newsletterTitle']));
	        $this->view->newsletterBody = $this->view->escape(stripslashes($newsletter[0]['newsletterBody']));
			$this->view->banner_b_campaign_id  = $this->view->escape(stripslashes($newsletter[0]['banner_b_campaign_id']));
			//var_dump($newsletter[0]['newsletterBody']);
			
			
        }

        if ($this->view->editNewsletter) {
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editNewsletter.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_newsletter.phtml');
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
