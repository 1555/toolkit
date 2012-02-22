<?php

///require_once APPLICATION_PATH . '/modules/newsletters/models/DbTable/Newsletters.php';

class Newsletters_IndexController extends Zend_Controller_Action
{
	
	protected $newsletterMod;
	protected $adminMod;
	protected $alertsMod;


	
    public function init()
    {
        
$this->newsletterMod = new Newsletters_Model_DbTable_Newsletters();
	$this->alertsMod = new Alerts_Model_DbTable_Alerts();
 $this->adminMod = new Admin_Model_DbTable_Admins();
    	
    	
    }
	
	
	
	public function createAction(){
		require_once APPLICATION_PATH . '/modules/newsletters/forms/Newsletter.php';
		$form = new Newsletters_Forms_Newsletter();
		$this->view->form = $form;
		$request = $this->getRequest();
 	//if($form->isValid($request->getPost())){
 		//echo "hatstand1";
 	    if (!$request->isPost()) {
		//  echo "hatstand2";
            // Failed validation; redisplay form
          //  $this->view->form = $form;
         $this->view->newNewsletter = true;
			
      
            //return;
      } else {
		  $newsletter = $request->getPost();
	//var_dump($newsletter);
		$this->_insertNewsletter($newsletter);
		unset($_REQUEST); ///////////******************************************************** USE THIS IN ALL FRAMEWORK!!!!!!!!
		 return $this->_forward('index', 'index', null);	
	  }
 	//}
		  
	  
	  
	 
	
   
		
		
		
	}
	
public function editAction(){
    	
	require_once APPLICATION_PATH . '/modules/newsletters/forms/NewsletterEdit.php';
    $form = new Newsletters_Forms_NewsletterEdit();
   	$campaignMod = $this->_getModel_campaigns();
    $this->view->campaigns = $campaignMod->getActiveCampaignsForDropDown();
  
    
     $request = $this->getRequest();	
     $id = $request->getParam('id');
    
     
 	
      if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       
            // Failed validation; redisplay form
           $newsletter = $this->_getModel()->getNewsletterById($id);
		   $this->view->paragraphs = $this->newsletterMod->getParagraphsForANewsletter($id);
		// var_dump( $this->view->paragraphs);
           $this->view->newsletter = $newsletter;
          
            $this->view->form = $form;
            $this->view->editNewsletter = true;
			
      
            return;
      }
      $newsletter = $this->getRequest()->getPost();
     // var_dump($newsletter);
	  $this->_updateNewsletter($newsletter, $id);
      unset($_REQUEST);
    return $this->_forward('index', 'index', null);
      
}

public function duplicateAction(){
   	$request = $this->getRequest();
	$id = $request->getParam('id');
   	$this->newsletterMod->duplicateNewsletter($id);
		$this->_redirector->gotoUrl('/newsletters/index/index/order/DESC');
        return; // never reached since default is to goto and exit
   	//return $this->_forward('index', 'index', 'alerts', array('id'=>''));
   	
   }
	
	

    public function indexAction()
    {
      
	 $request = $this->getRequest(); 
	 $order = $this->getRequest()->getParam('order');
if(isset($order)){ 
 $newsletters = $this->newsletterMod->getAllNewsLetters($order);
}else{
	$newsletters = $this->newsletterMod->getAllNewsLetters('DESC');
}
	 // var_dump($newsletters);
	 
$this->view->content = $newsletters; 
    	
    }
	
	public function managemultipleAction(){
    	//$this->getHelper('viewRenderer')->setNoRender();
    		$request = $this->getRequest();
    		$newsletters = $request->getPost();
    		//var_dump($campaigns);
    		
    		$this->deleteNewsletters($newsletters);
    		return $this->_forward('index', 'index', null);
    }
	
	public function submitAction(){
		
		
	//	$this->_helper->layout->disableLayout();
		//echo "whatcha";
		// collects the post data
		$request = $this->getRequest();
		 if ($request->isPost()) { 
		 	$bodyText = $request->getPost();
		 }
		
		// submits the bodytext
	//	$bodytextId = $this->submitBodyText();
		// create a newsletter obj
		$newsletterArray = $this->generateNewsLetterArray($bodyText);
		
		$newsLetterId = $this->submitNewsLettterArray($newsletterArray);
		
		
		//id of last used sckscrapper banner taken from the most recently generated guest alert
		// todays date
		// id of bodytext member
		
		
		// submit newsletter to the db
		
		// send marketing a link to the newsletter for them to edit
		// if newletterObj is successfully created look for the emails of mareting group and create an email.
	$res = $this->messageMarketing('5');
//	var_dump($res);
		
	}
	
	private function messageMarketing($id){
		$marketingEmails = $this->adminMod->getEmailsForGroup('marketing');
		//var_dump($marketingEmails);
	$link = $this->generateLinkWithId($id);
	//var_dump($link);
		$email = $this->generateEmail($link,$marketingEmails);
	
		//$this->placeFlagInDatabase('inishiated');
		
		
	}
	
	private function generateLinkWithId($id){
		return "<a href='http://toolkit-stage.cnbceuropeshared.com/public/newsletters/edit/id/$id'>Click here to edit this newsletter</a>";
	}
	
	private function generateEmail($link,$marketingEmails){
	
			//$request = $this->getRequest();
		// $post = $request->getPost();
		// $pword = $post['password'];
		 $email = "edward.hunton@cnbc.com";
		
			 $to = $email;
			 $subject = "Newsletter";
			 $from = "admin@toolkit-stage.cnbceuropeshared.com";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";  
			$headers .= "From: " . $from .  "\r\n"; 
			$headers .= "Reply-To: " . $from .  "\r\n"; 
			$headers .= "Return-Path: " . $from .  "\r\n";
			

 		//	$body = "Please follow this link to verify the newsletter: ".$link;
				$body = "<p>Please follow this link to verify the newsletter:</p><a href='#'>Click here</a>";
			
			
			
			
 				if (mail($to, $subject, $body,  $headers, "-f" . $from)) {
 			  echo("<p>Message successfully sent!</p>");
 					 } else {
  			 echo("<p>Message delivery failed...</p>");
  				}

		 

	//mail($to, $subject, $body,  $headers, "-f" . $from
		
	}
	
	  public function previewAction(){
		 
    	$this->_helper->layout->disableLayout();
    	$id = $this->getRequest()->getParam('id');
		 unset($_REQUEST);
    	$newsletter = $this->_getModel()->getCompoundNewsletter($id);
		
		$_camp = '2'; //***************************************** HARD CODED FOR 6 MONTH ADS campaign
		$config = Zend_Registry::get('config');
		$_db =  $config->newsletters->resources->db->params->dbname;
		$_user =  $config->newsletters->resources->db->params->username;
		$_pass =  $config->newsletters->resources->db->params->password;
		$_host =  $config->newsletters->resources->db->params->host;
		//$quotes = $this->getNewsletterSymbols();
		

//var_dump($config->newsletters->resources->db->params->username);
	
	//$src = "http://toolkit.cnbceuropeshared.com/public/assets/".$promo['company']."/images/volt/".$promo['image_name'];
	
	
	
		//$this->view->promo = $promo;
		//var_dump($alert);
   
    	//$alert['banner_a'] = '/tool/public/assets/'.$alert['banner_a_company_id'].'/'.$alert['banner_a_campaign_id'].'/images/banner/banner_a.jpg';
    	$newsletter['banner_b'] = 'http://toolkit.cnbceuropeshared.com/public/assets/'.$newsletter['banner_b_company_id'].'/campaigns/'.$newsletter['banner_b_campaign_id'].'/images/banner/skyscraper.gif';
		
		$newsletter['banner_clickthrough'] = 'http://toolkit.cnbceuropeshared.com/public/clickcatcher.php?campaigncode='.$_camp.'&db='.$_db.'&user='.$_user.'&password='.$_pass.'&host='.$_host.'';
    	//var_dump($alert);
    	//* being used when we are pulling specific images - now its 'banner_a.gif' etc.
    //	$bannerA = $this->campaignMod->getBanner($alert['banner_a_campaign_id']);
		//$bannerB = $this->campaignMod->getBanner($alert['banner_b_campaign_id']);
		
		//$bannerA_Path = $this->createBannerPath($bannerA['clickthroughurl'], $bannerA['company'],$alert['banner_a_campaign_id'],$bannerA['alt'], 468, 60);
		
		//$bannerB_Path = $this->createBannerPath($bannerB['clickthroughurl'], $bannerB['company'],$alert['banner_b_campaign_id'],$bannerB['alt'],160, 600);
		
	//	$this->view->bannerA = $bannerA_Path;
	//	$this->view->bannerB = $bannerB_Path;
	//	var_dump($bannerB);
		
    	//$alert['banner_b'] = $this->campaignMod->getBanner($alert['banner_b_campaign_id']);
   //	var_dump($alert['banner_b_campaign_id']);
    	//$shows = $this->alertMod->getAllShowForAnAlertWithStartAndEndTimesForCalender($id, $alert['date']);
    	//var_dump($shows);
    	
    	$this->view->newsletter = $newsletter;
    	
    	
    	
    	
    	
    }
	
	private function getNewsletterSymbols(){
		
	}
	
	private function placeFlagInDatabase($_flag){
		$this->newsletterMod->placeFlag($_flag);
	}
	
	private function submitBodyText(){
		
		// push body text into db; model newletters
		$this->newsletterMod->submitBody('bodytext');
		return $id;
		
	}
	
	private function generateNewsLetterArray($bodyText){
		
		// get id of latest skyscapper
		$skyscrapperid = $this->alertsMod->getLastSkyscapperId();
		//$skyscrapperid = '5';
		//$date = date();
		//if($skyscrapperid == 'undefined'){$skyscrapperid = '5';}; 
		$dataArray =  array('skyscrapper_id'=>$skyscrapperid, 'body_text'=>$bodyText['promoBod']);
		return $dataArray;
	}
	
	private function submitNewsLettterArray($nl){
	//	var_dump($nl);
		$this->newsletterMod->submitnl($nl);
		
	}


	protected function _updateNewsletter(array $newsletter, $id)
    {
        
        	  $this->_getModel()->updateNewsletter($newsletter, $id);
    }
    
    
protected function _insertNewsletter(array $newsletter)
    {
        //var_dump($alert);
    	$this->_getModel()->insertNewsletter($newsletter);
    

}

protected function _getModel()
    {
        if (null === $this->newsletterMod) {
                    $this->newsletterMod = new Newsletters_Model_DbTable_Newsletter();
                }
                return $this->newsletterMod;
    }
	
	protected function _getModel_campaigns()
    {
       // if (null === $this->campaignMod) {
                    $this->campaignMod = new Campaigns_Model_DbTable_Campaigns();
             //   }
                return $this->campaignMod;
    }
	
	 private function deleteNewsletters($newsletters){
    
      		$this->_getModel()->deleteNewsletters($newsletters);
    	
    }

	
}

