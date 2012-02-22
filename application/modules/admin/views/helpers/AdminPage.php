<?php
class Zend_View_Helper_AdminPage extends Zend_View_Helper_Abstract
{
    public function AdminPage()
    {
       $urlHome = $this->view->urlHome; 
	  
	    $this->view->id = "";
	        $this->view->username = "";
	        $this->view->password = "";
	        $this->view->firstname  = "";
			$this->view->lastname  = "";
			$this->view->email  = "";
			$this->view->role  = "";
		
		

        // If a new listing, show only the new listing form. 'newVenue' is set in the create action of the venue controller
        if ($this->view->newAdmin) {
            return $this->view->render('admins/_newAdmin.phtml');
        }

       $admin = $this->view->admin;
		
		
		//var_dump($screen);
		
		
		
		if ($admin) {    
            // If a valid listing is found, assign additional view variables
          //  var_dump($admin);
            //$this->view->ScreenID = $screen[0]->ScreenID;
            //$this->view->Name = $this->view->escape(stripslashes($screen[0]->Name));
            $this->view->id = $this->view->escape(stripslashes($admin['id']));
	        $this->view->username = $this->view->escape(stripslashes($admin['username']));
	        $this->view->password = $this->view->escape(stripslashes($admin['password']));
	        $this->view->firstname  = $this->view->escape(stripslashes($admin['firstname']));
			$this->view->lastname  = $this->view->escape(stripslashes($admin['lastname']));
			$this->view->email  = $this->view->escape(stripslashes($admin['email']));
			$this->view->role  = $this->view->escape(stripslashes($admin['role']));
			
			
        }

        if ($this->view->editAdmin) {
            // Show the edit listing form
			//echo "we salute you";
           // return $this->view->render('venues/_editVenue.phtml');
		    return $this->view->render('index/_editAdmin.phtml');
        }

        if (empty($this->view->viewHistory)) { /////. ********************** This is the default view presentation - the 'viewHistory' var is EMPTY
            // Show just the listing
            return $this->view->render('index/_admin.phtml');
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
