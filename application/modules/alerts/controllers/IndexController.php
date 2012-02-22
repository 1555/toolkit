


<?php

/**
 * 
 */

//require_once APPLICATION_PATH . '/modules/alerts/models/DbTable/Alerts.php';

class Alerts_IndexController extends Zend_Controller_Action
{

protected $alertMod;
protected $campaignMod;
protected $promoMod;
protected $_redirector = null;
protected $appSubDomian;
	
    public function init()
    {
        /* Initialize action controller here */
    	//Zend_Dojo::enableView($this->view);
    	$this->appSubDomain = APPLICATION_SUBDOMAIN;
    	$this->alertMod = new Alerts_Model_DbTable_Alerts();
		$this->promoMod = new Alerts_Model_DbTable_Promos();
    	$this->campaignMod = new Campaigns_Model_DbTable_Campaigns();
    	$this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
       // $this->_helper->layout->disableLayout();
    	$alerts = $this->alertMod->getAllAlerts();
      
    	$this->view->content = $alerts;
    }
	
	public function getallpromosAction(){
		
		$promos = $this->promoMod->getAllPromos();
		//var_dump($promos);
		$this->view->content = $promos;
		
	}
	
	public function createpromoAction(){
		
		  $request = $this->getRequest();
		 if ($request->isPost()) { 
		 	$alert = $request->getPost();
			$this->_insertPromo($alert);
			return $this->_forward('getallpromos', 'index', null);
		 } else {
		 $this->view->images = $this->campaignMod->getImagesForDropDown('64'); // 53 is cnbc
		require_once APPLICATION_PATH . '/modules/alerts/forms/Promo.php';
    	$this->view->form = new Alerts_Forms_Promo();
		
		  
		  
		 }
		
	}
	
	public function previewpromoAction(){
		$this->_helper->layout->disableLayout();
	}
	
	public function editpromoAction(){
		require_once APPLICATION_PATH . '/modules/alerts/forms/PromoEdit.php';
		$form = new Alerts_Forms_PromoEdit();
		$id = $this->getRequest()->getParam('id');
  		  $request = $this->getRequest();
		if (!$request->isPost()) { 
      //  var_dump($id);
           $this->view->images = $this->campaignMod->getImagesForDropDown('64'); // 53 is cnbc
           $this->view->promo = $this->promoMod->getPromo($id);
          $this->view->form = $form;
		$this->view->id = $id;
			$this->view->editPromo = true;
			
      
            return;
      }
	  
	  $promo = $this->getRequest()->getPost();
    //  var_dump($id);
      $this->_updatePromo($promo, $id);
      
     return $this->_forward('getallpromos', 'index', null);
		
		
		
	}
    
    public function previewAction(){
    	$this->_helper->layout->disableLayout();
    	$id = $this->getRequest()->getParam('id');
    	$alert = $this->alertMod->getAlert($id);
		$promo = $this->alertMod->getPromo($alert['promo_id']);
		$this->view->subdom = $this->appSubDomain;

//var_dump($promo);
	
	$src = "http://".$this->appSubDomain.".cnbceuropeshared.com/public/assets/".$promo['company']."/images/volt/".$promo['image_name'];
	$link = $promo['link'];
	$headline = stripslashes($promo['title']);
	$body = stripslashes($promo['content']);
	
	$promo =  "
	<!-- left coll to push img to the right 
	<td width='2px'>
	<img src='http://".$this->appSubDomain.".cnbceuropeshared.com/public/guest_alert/spacer.gif' width='0px'>
	</td> -->
	
	<!-- promo img -->
	<td style='vertical-align:top;'>
	<a href='$link' ><img src='$src' border='0' ></a>
	</td>
	
	<!-- spacer coll to seperate promo img from headline -->
	<td width='10'>
	<img src='http://".$this->appSubDomain.".cnbceuropeshared.com/public/guest_alert/spacer.gif' width='10px'>
	</td>
	
	<!-- contains headline and body text -->
	<td style='vertical-align:text-top;'>
		<table width='200px'>
			<tr><a href='$link' style='text-decoration:none;color:rgb(0, 84, 128);'><font face='Arial, Helvetica, sans-serif' color='#005480' size='3'><strong>$headline</strong></font></a><br/></tr>
			<tr><font face='Arial, Helvetica, sans-serif' color='rgb(102, 102, 102)' size='2'>$body</font></tr>
		</table>
	</td>";
		$this->view->promo = $promo;
		//var_dump($alert);
   
    	//$alert['banner_a'] = '/tool/public/assets/'.$alert['banner_a_company_id'].'/'.$alert['banner_a_campaign_id'].'/images/banner/banner_a.jpg';
    	//$alert['banner_b'] = '/tool/public/assets/'.$alert['banner_b_company_id'].'/'.$alert['banner_b_campaign_id'].'/images/banner/banner_b.jpg';
    	//var_dump($alert);
    	//* being used when we are pulling specific images - now its 'banner_a.gif' etc.
    	$bannerA = $this->campaignMod->getBanner($alert['banner_a_campaign_id']);
		$bannerB = $this->campaignMod->getBanner($alert['banner_b_campaign_id']);
		
		$bannerA_Path = $this->createBannerPath($bannerA['clickthroughurl'], $bannerA['company'],$alert['banner_a_campaign_id'],$bannerA['alt'], 468, 60);
		
		$bannerB_Path = $this->createBannerPath($bannerB['clickthroughurl_B'], $bannerB['company'],$alert['banner_b_campaign_id'],$bannerB['alt'],160, 600);
		
		$this->view->bannerA = $bannerA_Path;
		$this->view->bannerB = $bannerB_Path;
	//	var_dump($bannerB);
		
    	//$alert['banner_b'] = $this->campaignMod->getBanner($alert['banner_b_campaign_id']);
   //	var_dump($alert['banner_b_campaign_id']);
    	$shows = $this->alertMod->getAllShowForAnAlertWithStartAndEndTimesForCalender($id, $alert['date']);
    	//var_dump($shows);
    	
    	$this->view->alert = $alert;
    	$this->view->shows = $shows;
    	
    	
    	
    	
    }
	
	public function createBannerPath($_click, $_comp,$_camp, $_alt, $_width, $_height){
		
		if($_width == 468){
			$file = 'banner.gif';
			$position = 'banner';
			
		} else {
			$file = 'skyscraper.gif';
			$position = 'skyscrapper';
		}
		
		return "<a href='http://".$this->appSubDomain.".cnbceuropeshared.com/public/clickcatcher.php?campaigncode=".$_camp."&position=".$position."'><img src='http://".$this->appSubDomain.".cnbceuropeshared.com/public/assets/".$_comp."/campaigns/".$_camp."/images/banner/".$file."' width='$_width' height='$_height' style='border:none;vertical-align:top;float:left;'></a>";
	}
	
	public function getcompanybycampaignidAction(){
		$this->_helper->layout->disableLayout();
		$id = $this->getRequest()->getParam('id');
		$comp = $this->alertMod->getCompanyByCampaignId($id);
		$c = rtrim($comp['company']);
		echo $c;
		
	}
    
    public function getabannerlocationAction(){
    	$this->_helper->layout->disableLayout();
	    $request = $this->getRequest();
	    $id = $request->getParam('id');
	    //$promo = $this->alertMod->getPromo($id);
	    echo $id ; //$promo['content'];
    	//$request = $this->getRequest();
    	//$id = $request->getParam('campaign');
    	
    	//$compId = $this->alertMod->getCompanyByCampaignId($id);
    	//;
    	//echo $compId;
    	
    	
    	
    	
   }
   
   public function duplicateAction(){
   	$request = $this->getRequest();
	$id = $request->getParam('id');
   	$this->alertMod->duplicateAlert($id);
		$this->_redirector->gotoUrl('/alerts/index/index');
        return; // never reached since default is to goto and exit
   	//return $this->_forward('index', 'index', 'alerts', array('id'=>''));
   	
   }
   
public function getapromohtmlAction(){
		$this->_helper->layout->disableLayout();
	$request = $this->getRequest();
	$id = $request->getParam('id');
	
	$promo = $this->alertMod->getPromo($id);
	//$promo['company'] = 
//	$promo['image_name'] = 
//	var_dump($promo);
	$src = "http://".$this->appSubDomain.".cnbceuropeshared.com/public/assets/".$promo['company']."/images/volt/".$promo['image_name'];
	$link = $promo['link'];
	$headline = $promo['title'];
	$body = $promo['content'];
	
	echo "<tr>
			<td width='250'><a href='$link' ><img src='$src' border='0'></a></td>
			<td><table>
				<tr style='Font-weight:bold;'><a href='$link' style='text-decoration:none;color:rgb(0, 84, 128);'><font face='Arial, Helvetica, sans-serif' color='#005480' size='2'>$headline</font></a></tr>
				<tr><font face='Arial, Helvetica, sans-serif' color='rgb(102, 102, 102)' size='2'><p>$body</p></font></tr>
				</table>
			</td>
		<tr>";
	
	
	
}

public function getrssAction(){
	$this->_helper->layout->disableLayout();
	
	$xml = $this->alertMod->getRss();
	
	echo $xml;
	//var_dump($xml);
	//$this->_helper->layout->disableLayout();
	//echo "hot fudge";
	
	
}
   
public function getapromoAction(){
	$this->_helper->layout->disableLayout();
	$request = $this->getRequest();
	$ida = $request->getParam('ida');
	$idb = $request->getParam('idb');
	$compIda = $this->alertMod->getCompanyByCampaignId($ida);
	$compIdb = $this->alertMod->getCompanyByCampaignId($idb);
	$ca = $compIda['company'];
	$cb = $compIdb['company'];
	$bans = $ca.' '.$cb;
	//$promo = $this->alertMod->getPromo($id);
	//$bans = array();
	//array_push($bans,$ca);
	//array_push($bans,$cb);
	echo $bans; // $compId ; //$promo['content'];
	//$request = $this->getRequest();	
   // $id = $request->getParam('promoid');
	//echo "<p>kjhasjdf</p>";
	
}

public function promosmanagemultipleAction(){
	$request = $this->getRequest();
    		$promos = $request->getPost();
    		//var_dump($campaigns);
    		
    		$this->deletePromos($promos);
    		return $this->_forward('getallpromos', 'index', null);
	
	
}
    
public function managemultipleAction(){
    	//$this->getHelper('viewRenderer')->setNoRender();
    		$request = $this->getRequest();
    		$alerts = $request->getPost();
    		//var_dump($campaigns);
    		
    		$this->deleteAlerts($alerts);
    		return $this->_forward('index', 'index', null);
    }
    
    
    private function deleteAlerts($alerts){
    
      		$this->alertMod->deleteAlerts($alerts);
    	
    }
	
	private function deletePromos($promos){
    
      		$this->promoMod->deletePromos($promos);
    	
    }
	
    
public function editAction(){
    	
	require_once APPLICATION_PATH . '/modules/alerts/forms/AlertEdit.php';
    $form = new Alerts_Forms_AlertEdit();
   	$campaignMod = $this->_getModel_campaigns();
    $this->view->campaigns = $campaignMod->getActiveCampaignsForDropDown();
     $this->view->promos = $this->alertMod->getAllPromosForDropDown();
    
     $request = $this->getRequest();	
     $id = $request->getParam('id');
     $this->view->guests = $this->alertMod->getGuestsForAnAlert($id);
     
 	// var_dump($this->view->promos);
   
   //	var_dump($form);
      if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       
            // Failed validation; redisplay form
           $alert = $this->_getModel()->getAlertById($id);
           $this->view->alert = $alert;
           if(isset($alert['promo_id'])){
         		 $promo = $this->campaignMod->getPromoForAnAlert($alert['promo_id']);
           		
				$this->view->promo = $promo;
           }
            $this->view->form = $form;
            $this->view->editAlert = true;
			
      
            return;
      }
      $alert = $this->getRequest()->getPost();
      ?><pre><?php 
     //var_dump($alert);
      ?></pre><?php
      $this->_updateAlert($alert, $id);
      
     return $this->_forward('index', 'index', null);
      
}


public function createAction(){
	require_once APPLICATION_PATH . '/modules/alerts/forms/Alert.php';
    $form = new Alerts_Forms_Alert();
    $this->view->form = $form;
    $campaignMod = $this->_getModel_campaigns();
    $this->view->campaigns = $campaignMod->getActiveCampaignsForDropDown();
    $this->view->promos = $this->alertMod->getAllPromosForDropDown();
//	/ var_dump($this->getRequest()->getPost()); 
 	$request = $this->getRequest();
 	if($form->isValid($request->getPost())){
 		//echo "hatstand1";
 	    if (!$request->isPost()) {
		//  echo "hatstand2";
            // Failed validation; redisplay form
            $this->view->form = $form;
        //  $this->view->newAlert = true;
			
      
            return;
      }
 	}
    

   // echo "hatstand"; 
		
		// Create article array
		
     // echo "<pre>";
      //$test = $form->getValues();
		//var_dump($form->getValue('promoCopy'));
		//var_dump($this->getRequest()->getPost());
        $alert = $request->getPost(); //$forms->getValues(); //$this->getRequest()->getPost();
		//var_dump($alert);
	//	if($alert['promoValue'] == '0'){
		// $this->alertMod->createNewPromo($alert['promoValue']);	
	//	}
        //$alert['banner_a_campaign_id']
        $a = $campaignMod->getCompanyFromCampaignId($alert['banner_a_campaign_id']);
        $b = $campaignMod->getCompanyFromCampaignId($alert['banner_b_campaign_id']);
        $a = $a['company'];
        $b = $b['company'];
      $alert['banner_a_company'] = $a;
      $alert['banner_b_company'] =  $b;
		$this->_insertAlert($alert);
		//var_dump($alert);
	//	echo "</pre>";
	//	var_dump($alert);
		//echo "works";
	  
	 
	
   return $this->_forward('index', 'index', null);

		
		
		
	}
	
protected function _updateAlert(array $alert, $id)
    {
        //  var_dump($user." is the venue");
        	//   var_dump($id." is the id");
        	  $this->_getModel()->updateAlert($alert, $id);
    }
	
	protected function _updatePromo(array $promo, $id)
    {
        //  var_dump($user." is the venue");
          //var_dump($id." is the id");
        	  $this->_getModel_promo()->updatePromo($promo, $id);
    }
    
    
protected function _insertAlert(array $alert)
    {
        //var_dump($alert);
    	$this->_getModel()->insertAlert($alert);
    }
	
	protected function _insertPromo(array $promo)
    {
        
    	$this->_getModel_promo()->insertPromo($promo);
    }
    
    protected function _getModel()
    {
        if (null === $this->alertMod) {
                    $this->alertMod = new Alerts_Model_DbTable_Alerts();
                }
                return $this->alertMod;
    }
    
protected function _getModel_campaigns()
    {
       // if (null === $this->campaignMod) {
                    $this->campaignMod = new Campaigns_Model_DbTable_Campaigns();
             //   }
                return $this->campaignMod;
    }

protected function _getModel_promo()
    {
       // if (null === $this->campaignMod) {
                    $this->promoMod = new Alerts_Model_DbTable_Promos();
             //   }
                return $this->promoMod;
    }


}

