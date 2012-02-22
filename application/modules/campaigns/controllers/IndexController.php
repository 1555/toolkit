<?php



class Campaigns_IndexController extends Zend_Controller_Action
{

	protected $campMod;
	
    public function init()
    {
        /* Initialize action controller here */
    	$this->campMod = new Campaigns_Model_DbTable_Campaigns();
	
		// if($_SERVER["APPLICATION_ENV"] == 'development'){
			// $this->view->pathPrefix = "/tool";
		// } else {
			//  $this->view->pathPrefix = "";
		// }
    }

    public function uploadimagesAction(){
    	require_once APPLICATION_PATH . '/modules/campaigns/forms/Image.php';
    	 $this->view->form = new Campaigns_Forms_Image();
    	
    	$request = $this->getRequest();
    	$id = $request->getParam('company');
    	$this->view->id = $id;
    	if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       
            // Failed validation; redisplay form
          
            
           
           if(empty($id)){ $this->view->companies = $this->campMod->getCompaniesForDropDown();};
            $this->view->newImages = true;
			
      
            return;
      }
	  
	
       $images = $this->getRequest()->getPost();
       if(empty($id)){$id = $images['company_id'];};
    	$adapter=new Zend_File_Transfer_Adapter_Http();
		$imgPath = 'assets/'.$id.'/images/volt';
		
		$uploadDir=$imgPath;
		$adapter->setDestination($uploadDir);
		$n = 1;
		foreach ($adapter->getFileInfo() as $info){
			
		

		
		$images['imagesubs'][$n]['name'] = $info['name'];
	//	var_dump($images);
		/// $fileName = $images['imagesubs'][$n]['newname'].'.gif'; **************** Works
		
		 $userId = Zend_Auth::getInstance()->hasIdentity();
		$rand = rand(1000, 9000);
		$fileName = implode('_',array($rand, $userId, 'CNBC',date('h-i-s-j-m-y')));
		$fileName .= '.gif';
		$images['imagesubs'][$n]['newname'] = $fileName;
		
		$this->view->msg=$adapter->getMessages();
		if(isset($id)){
		$this->_insertImage($images['imagesubs'][$n], $id);
		}else {
			$id = $images['imagesubs'][$n]['companyid'];
			$this->_insertImage($images['imagesubs'][$n], $id);
		}
		$n++;
		
		$adapter->addFilter('Rename', array('target' => $uploadDir.DIRECTORY_SEPARATOR.$fileName,'overwrite' => true));
		
		if(!$adapter->receive($info['name'])){
			
				return;
	
			}
		} 
		//var_dump($images);
		return $this->_forward('getimagesbycompany', 'index', null, array('id'=>$id));
    }
    
    public function getAllPromos(){
    	// gets all the promos
    	$this->campMod->getAllPromos();
    }
    
    
    public function indexAction()
    {
        // action body
        //$this->getHelper('viewRenderer')->setNoRender();
      		$camps = $this->campMod->getAllCampaigns();
			//var_dump($camps);
      		$camps = $this->campMod->addClickThroughsToCampaigns($camps);
			
			$this->view->content = $this->campMod->addImagesToCampaigns($camps);
    //var_dump($camps);
    	
    }
    
    public function updatemultipleimagesAction(){
    	//$this->getHelper('viewRenderer')->setNoRender();
    		$request = $this->getRequest();
    		$images = $request->getPost();
    		//var_dump($images);
    		$this->setImagesAsBanners($images);
    		$this->deleteImages($images);
    		return $this->_forward('image', 'index', null);
    }
    
    public function updatemultiplecompaniesAction(){
    	//$this->getHelper('viewRenderer')->setNoRender();
    		$request = $this->getRequest();
    		$companies = $request->getPost();
    		//var_dump($images);
    		
    		$this->deleteCompanies($companies);
    		return $this->_forward('companies', 'index', null);
    }
    
	public function managemultipleAction(){
    	//$this->getHelper('viewRenderer')->setNoRender();
    		$request = $this->getRequest();
    		$campaigns = $request->getPost();
    		//var_dump($campaigns);
    		
    		$this->deleteCampaigns($campaigns);
    		return $this->_forward('index', 'index', null);
    }
	
	 
	  public function filterbyAction(){ 
		  	
    	 $request = $this->getRequest();
    	 $filter = $request->getParam('filter');
    	
    	 $camps= $this->campMod->getCampaignsBy($filter);
    	$this->view->content = $this->campMod->addClickThroughsToCampaigns($camps);
    	
    		
    		
    	}
    
    
    
    private function setImagesAsBanners($images){
    	$this->campMod->setImageAsBanner($images);
    	
    }
    
	private function deleteImages($images){
    
      		$this->campMod->deleteImages($images);
    	
    }
    
	private function deleteCompanies($companies){
    
      		$this->campMod->deleteCompanies($companies);
    	
    }
    
	private function deleteCampaigns($campaigns){
    
      		$this->campMod->deleteCampaigns($campaigns);
    	
    }
    
public function editAction(){
    	
    require_once APPLICATION_PATH . '/modules/campaigns/forms/CampaignEdit.php';
   $form = new Campaigns_Forms_CampaignEdit();
    $campMod = $this->_getModel();
    //$this->view->companies = $campMod->getCompaniesForDropDown();
    $request = $this->getRequest();
    $id = $request->getParam('id');
	
	
   	$company_id = $campMod->getCompanyFromCampaignId($id);
    $this->view->images = $campMod->getImagesForDropDown($company_id['company']);
    //var_dump( $this->view->images);
   	
   	
       if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       
            // Failed validation; redisplay form
            $campaign = $this->_getModel()->getCampaignById($id);
            $this->view->company_id = $company_id['company'];
            $this->view->campaign = $campaign;
            $this->view->form = $form;
            $this->view->editCampaign = true;
			
    
            return;
      }
      

      
      
   		$campaign = $this->getRequest()->getPost();
   		
   		$this->transferfiles($campaign, $id, $company_id['company']);
   		
		//var_dump($campaign);
		//$adapter=new Zend_File_Transfer_Adapter_Http();
		$n = $campaign['theValue'];
		//var_dump($n);
		//foreach ($adapter->getFileInfo() as $info){
			//var_dump($info);
		//	$campaign['imagesubs'][$n]['name'] = $info['name'];
			//var_dump($campaign['imagesubs'][$n]);
		//	$n++;
	//	}
		//$auth = Zend_Auth::getInstance();

	//	$userId = $auth->getIdentity();
		//$campaign['userid'] = $this->getIdFromEmail($userId->email);
		$this->_updateCampaign($campaign,$id);
		
	//	$imgPath = 'assets/'.$campaign['company_id'].'/'.$id.'/images/volt/';
		//var_dump($imgPath);
	//	$uploadDir=$imgPath;
		//$adapter->setDestination($uploadDir);
		
		
	
		//$n = $campaign['theValue']-1;
		//foreach ($adapter->getFileInfo() as $info){

		//var_dump($info);
		
		//$campaign['imagesubs'][$n]['name'] = $info['name'];
		
			//if(!$adapter->receive($info['name'])){
			
				//$this->view->msg=$adapter->getMessages();
				
				//return;
	
			//}
			
			//$n++;

		//} 
      
     
     
		//$this->_updateCampaign($campaign, $id);
	//	echo "</pre>";
		//var_dump($alert);
		//echo "works";*/
	  
	 
	
 return $this->_forward('index', 'index', null);
      
    	
    	
    }
	
	
    
    private function transferfiles($campaign, $id,$company_id ){
    	
    	// copy file
		//var_dump($campaign);
    	$campMod = $this->_getModel();
    	$banner_name =  $campMod->getImageName($campaign['banner_id']); 
		$skyscraper_name =  $campMod->getImageName($campaign['skyscraper_id']); 
    	//var_dump($banner_name);
		//var_dump($skyscraper_name);
		if($banner_name != false){
			$result = copy('assets/'.$company_id.'/images/volt/'.$banner_name['image_name'], 'assets/'.$company_id.'/campaigns/'.$id.'/images/banner/banner.gif');
			if($result != '1'){
				echo "your files did not transfer";
			}
		//}else {
			//unlink('assets/'.$company_id.'/campaigns/'.$id.'/images/banner/banner.gif');
			//if($result != '1'){
			//	echo "your files did not transfer";
		//}
			
		}
			//var_dump($skyscraper_name);
			if($skyscraper_name != false){
	$result = copy('assets/'.$company_id.'/images/volt/'.$skyscraper_name['image_name'], 'assets/'.$company_id.'/campaigns/'.$id.'/images/banner/skyscraper.gif');
    	if($result != '1'){
    		echo "your files did not transfer";
 			}
		//	} else {
				
				//unlink('assets/'.$company_id.'/campaigns/'.$id.'/images/banner/skyscraper.gif');
			//if($result != '1'){
			//	echo "your files did not transfer";
		//	}
				
			}
    	
    }
    
    public function companiesAction(){
    	
    	 $campMod = $this->_getModel();
   		 $this->view->content = $campMod->getCompanies();
    }
    
public function imageeditAction(){
      	
      	require_once APPLICATION_PATH . '/modules/campaigns/forms/ImageEdit.php';
	    $form = new Campaigns_Forms_ImageEdit();
	   	$request = $this->getRequest();
	   	$id = $request->getParam('id');
	  $image = $this->_getModel()->getImageById($id);  	
if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       //if (!$form->isValid($this->getRequest()->getPost())) {
		  // echo "hatstand2";
            // Failed validation; redisplay form
            $this->view->image = $image;
            $this->view->form = $form;
            $this->view->editImage = true;
			return;
      }
	  
	  $image = $this->getRequest()->getPost();
	  
	 $this->_updateImage($image,$id);
      
      return $this->_forward('image', 'index', null);
      	
      	
      }
    
    public function imageAction(){
    	
   	 	//$this->getHelper('viewRenderer')->setNoRender();
   	
     $campMod = $this->_getModel();
    $this->view->companies = $campMod->getCompaniesForDropDown();
   	 	
    $campMod = $this->_getModel();
    $this->view->content = $campMod->getImages();
  // var_dump($this->view->content);
    	
    }
    
    public function getimagesbycompanyAction(){
    	$campMod = $this->_getModel();
    	 $this->view->companies = $campMod->getCompaniesForDropDown();
    	$request = $this->getRequest();
    	$id = $request->getParam('id');
    	$this->view->id = $id;
    	$campMod = $this->_getModel();
        $this->view->content = $campMod->getImagesByCompany($id);
        
    	
    }
    
public function createAction(){
	require_once APPLICATION_PATH . '/modules/campaigns/forms/Campaign.php';
    $form = new Campaigns_Forms_Campaign();
    $request = $this->getRequest();
    $images = $request->getPost();
    $id = $request->getParam('company');
    $userId = Zend_Auth::getInstance()->hasIdentity();
	
    //require_once APPLICATION_PATH . '/modules/alerts/forms/Alert.php';
   // $form = new Alerts_Forms_Alert();
    $campMod = $this->_getModel();
    $this->view->companies = $campMod->getCompaniesForDropDown();
	$this->view->images = $campMod->getImagesForDropDown($id);
	$this->view->id = $id;
    // var_dump( $this->view->images); 
 	$request = $this->getRequest();
      if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       //if (!$form->isValid($this->getRequest()->getPost())) {
		  // echo "hatstand2";
            // Failed validation; redisplay form
            $this->view->form = $form;
            $this->view->newCampaign = true;
			return;
      }
      
		
		$campaign = $this->getRequest()->getPost();
		
		$adapter=new Zend_File_Transfer_Adapter_Http();
		$n = 1;
		foreach ($adapter->getFileInfo() as $info){
			//var_dump($info);
			$campaign['imagesubs'][$n]['name'] = $info['name'];
			$n++;
		}
		$auth = Zend_Auth::getInstance();

		$userId = $auth->getIdentity();
		
		$campaign['userid'] = $userId->id;
		$imgPath = $this->_insertCampaign($campaign);
	//var_dump($imgPath);
		$this->transferfiles($campaign, $imgPath['campaignid'], $id);
		if($imgPath != "error"){
		
		$uploadDir=$imgPath['path'];
		$adapter->setDestination($uploadDir);
		$n = 0;
		foreach ($adapter->getFileInfo() as $info){
		if(!$adapter->receive($info['name'])){
			
				$this->view->msg=$adapter->getMessages();
				
				return;
	
			}
			
			$n++;

		}
		
		} else {
			echo "There was an error creating this campaign. The campaigns title may not be unique.";
		}
	
	 	return $this->_forward('index', 'index', null);

		
		
		
	}
	
public function createcompanyAction(){
	require_once APPLICATION_PATH . '/modules/campaigns/forms/Company.php';
    $form = new Campaigns_Forms_Company();
   // $campMod = $this->_getModel_campaigns();
  //  $this->view->campaigns = $campMod->getActiveCampaignsForDropDown();
	// var_dump($this->getRequest()->getPost()); 
 	$request = $this->getRequest();
      if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
       //if (!$form->isValid($this->getRequest()->getPost())) {
		  // echo "hatstand2";
            // Failed validation; redisplay form
            $this->view->form = $form;
            $this->view->newCompany = true;
			
      
            return;
      }
      
	
		
        $company = $this->getRequest()->getPost();
        
       // var_dump($company);
        
		$this->_insertCompany($company);
	
	 	return $this->_forward('companies', 'index', null);

		
		
		
	}
	
public function editcompanyAction(){
	require_once APPLICATION_PATH . '/modules/campaigns/forms/CompanyEdit.php';
    $form = new Campaigns_Forms_CompanyEdit();
   // $campMod = $this->_getModel_campaigns();
  //  $this->view->campaigns = $campMod->getActiveCampaignsForDropDown();
	// var_dump($this->getRequest()->getPost()); 
 	 $request = $this->getRequest();
 	  $id = $request->getParam('company');
      if (!$request->isPost()) { //|| !$form->isValid($request->getPost()
      	 
      	
   		 $id = $request->getParam('company');
      	 $company = $this->_getModel()->getCompanyById($id);
      	//var_dump($id);
       //if(!$form->isValid($this->getRequest()->getPost())) {
		  // echo "hatstand2";
            // Failed validation; redisplay form
            $this->view->id = $id;
            $this->view->company = $company;
            $this->view->form = $form;
            $this->view->editCompany = true;
			
    
            return;
      }
      
	
		
        $company = $this->getRequest()->getPost();
        
       // var_dump($company);
        
		$this->_updateCompany($company,$id);
	
	 	return $this->_forward('companies', 'index', null);

		
		
		
	}
	
protected function _updateCampaign(array $campaign, $id)
    {
        //s  var_dump($campaign);
        	//   var_dump($id." is the id");
        	  $this->_getModel()->updateCampaign($campaign, $id);
    }
	
	protected function _updateImage(array $image, $id)
    {
       // var_dump($image);
        	//   var_dump($id." is the id");
        	  $this->_getModel()->updateImage($image);
    }
    
protected function _insertCampaign(array $campaign)
    {
       // var_dump("in camp");
    	$path = $this->_getModel()->insertCampaign($campaign);
    	return $path;
    }
    
protected function _insertImage(array $image, $company)
    {
     
    	$this->_getModel()->insertImage($image, $company);
    	
    }
    
protected function _insertCompany(array $company)
    {
       // var_dump("in camp");
    	$this->_getModel()->insertCompany($company);
    }
    
    protected function _updateCompany(array $company, $id)
    {
       // var_dump("in camp");
    	$this->_getModel()->updateCompany($company, $id);
    }
    
    
    protected function _getModel()
    {
        if (null === $this->campMod) {
                    $this->campMod = new Campaigns_Model_DbTable_Campaigns();
                }
                return $this->campMod;
    }


}

