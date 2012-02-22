<?php

	

class Campaigns_Model_DbTable_Campaigns{
	
	public $db;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->campaigns->resources->db); 
		
	}
	
	public function getActiveCampaignsForDropDown(){
		$campaigns = $this->getActiveCampaigns();
		$camps = $this->createKeyValuePairs($campaigns, 'id', 'title');
		//return $campaigns;
		return $camps;
		
		
	}
	
	public function getAllPromos(){
		$sql = "SELECT * FROM campaigns_promos";
		
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		
	}
	
public function getCompaniesForDropDown(){
		$companies = $this->getCompanies();
		$comps = $this->createKeyValuePairs($companies, 'id', 'companyname');
		//return $campaigns;
		return $comps;
		
		
	}
	
	
	
	private function createKeyValuePairs($array, $k, $v){
		//$_camps = array($camps[0]['id'] => $camps[0]['title'],$camps[1]['id'] => $camps[1]['title']);
		$_camps = array();
		$n = 0;
		
		foreach($array as $c){
			if($n == 0){
				array_push($_camps, '<< Select >>');
			}
			//var_dump($c);
			//$_camps[] = array($c['id'] => $c['title']);
			$_camps[$c[$k]] = $c[$v];
			//array_push($_camps, array($c['id'] => $c['title'])); -- good if you need optionGroups
			$n++;
		}
		
		
		
		if(count($_camps) == 0){
			array_push($_camps, 'There are no images associated with this company');
		}
		
	return $_camps;
	}
	
	public function getActiveCampaigns(){
		
		$select = $this->db->select();
		$sql = 'SELECT title, id FROM campaigns WHERE enddate > NOW()';
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
		
	}
	
	public function getCampaignNames(){
		//$this->db = cnbc_Db::getAdapter(); 
		$select = $this->db->select();
        $select->from('campaigns_images', array('name'));
			   
		try {
            $this->db->setFetchMode(Zend_Db::FETCH_OBJ);
            $result = $this->db->fetchCol($select);
        } catch (Zend_Db_Exception $e) {
            //Filmed_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
		//var_dump($result);
		return $result;
		
		
	}
	
	//public function getCampaignsForCo
	
	public function getCompanies(){
		$sql = "SELECT * FROM campaigns_companies";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
	}
	
	public function getCampaignsByCompany($id){
		
	}
	
	public function getImagesByCompany($id){
		//$sql = "SELECT c.title, i.campaign_id, i.company, c.id, i.image_name, i.id as image_id, c.banner_id FROM campaigns c RIGHT JOIN  images i  WHERE c.company = '$id' AND i.company = '$id' ORDER BY i.campaign_id";
		$sql = "SELECT company, image_name, id, description FROM campaigns_images WHERE company = '$id'";
		//$sql = "SELECT * FROM images WHERE company = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
	}
	
	public function getImages(){
		$sql = "SELECT company,id,image_name, id, description FROM campaigns_images";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
	}
	
	public function deleteImages($images){
		//var_dump($images);
		while ($on = current($images)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($images));
	       // var_dump($num);
	      $sql = "DELETE FROM campaigns_images WHERE id = '$id'";
		$result = $this->db->query($sql);
	    }
    	next($images);
		}
	}
	
public function deleteCompanies($companies){
		//var_dump($images);
		while ($on = current($companies)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($companies));
	       // var_dump($num);
	      $sql = "DELETE FROM campaigns_companies WHERE id = '$id'";
		$result = $this->db->query($sql);
	    }
    	next($companies);
		}
	}
	
public function deleteCampaigns($campaigns){
		//var_dump($images);
		while ($on = current($campaigns)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($campaigns));
	       // var_dump($num);
	      $sql = "DELETE FROM campaigns WHERE id = '$id'";
		$result = $this->db->query($sql);
	    }
    	next($campaigns);
		}
	}
	
	public function getPromoForAnAlert($promo_id){
		$sql = "SELECT * FROM campaigns_promos WHERE id = '$promo_id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
	}
	
	private function getNum($key){
		return substr($key, 7, strlen($key)-1);
	}
	
	public function setImageAsBanner($images){
		//var_dump($images);
		while ($on = current($images)) {
		//	var_dump($images);
	    	if (is_string($on)) {
	    		$campain_id = key($images);
	    		$bannerimage_id = $images[$campain_id];
	      		$myvar = setType($campain_id, "integer");
	     		// var_dump($bannerimage_id);
	     		  //var_dump($myvar);
	      		if(is_int($campain_id)){
	      			//var_dump($campain_id); 
	      			//var_dump($bannerimage_id); 
	      			 $sql = "UPDATE campaigns SET banner_id  = '$bannerimage_id' WHERE id = '$campain_id'";
	      			 $result = $this->db->query($sql);
	      		}
	      		
	        	//$id= $this->getNum(key($images));
	       		//var_dump($id);
		      	//$result = $this->db->query($sql);
	    }
    	next($images);
		}
	}
	
	public function getAllImageForACampaign($id){
	//	var_dump($id);
		$sql = "SELECT c.title,  c.id, i.image_name, i.id as image_id, c.banner_id FROM campaigns_images i, campaigns c WHERE  i.company = '$id' ";
		//$sql = "SELECT * FROM images WHERE campaign_id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
	}
	
	public function getCampaignsBy($_filter){
		
		$sql = "SELECT i.image_name, com.companyname, com.id as comid,c.id,  c.modifiedbyid, c.title, c.startdate, c.enddate, c.description, c.company FROM campaigns c, campaigns_companies com, campaigns_images i WHERE com.id = c.company and c.banner_id = i.id ORDER BY '$_filter'";
		//$sql = "SELECT * FROM images WHERE campaign_id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows; //$rows;
		
		
		
	}
	
	public function addClickThroughsToCampaigns($campaigns){
		$n = 0;
		foreach($campaigns as $c){
			$id = $c['id'];
			$user = $c['modifiedbyid'];
			//var_dump($id);
			$sql = "SELECT COUNT(*) FROM campaigns_clickthroughs WHERE campaigncode = '$id'";
			$result = $this->db->query($sql);
			$rows = $result->fetch();
			$result->closeCursor();
			array_push($campaigns[$n], $rows);
			$sql = "SELECT  * FROM admin_users WHERE id = '$user'";
			$result = $this->db->query($sql);
			$userdetails = $result->fetch();
			//$result->closeCursor();
			//var_dump($rows);
			array_push($campaigns[$n], $userdetails);
			$n++;
		}
		//var_dump($campaigns);
		return $campaigns;
	}
	
	public function getUserForCampaign(){
		
		
	}
	
	
	
	public function getAllCampaigns(){
		///i.image_name, com.companyname, com.id as comid,c.id,  c.useforalerts, c.usefornewsletter, c.modifiedbyid, c.title, c.startdate, c.enddate, c.description, c.company
		$sql = 'SELECT com.companyname,com.id as comid, c.useforalerts, c.usefornewsletter, c.banner_id, c.skyscraper, c.modifiedbyid, c.title, c.startdate, c.enddate, c.description, c.clickthroughurl, c.clickthroughurl_B, c.id, c.company FROM campaigns c, campaigns_companies com WHERE com.id = c.company'; // and  and c.banner_id = i.id
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	public function addImagesToCampaigns($campaigns){
		
		$n = 0;
		foreach($campaigns as $c){
		//	var_dump($c);
		//	echo 'bastard';
			$bannerid = $c['banner_id'];
			$skyscraperid = $c['skyscraper'];
			$sql = "SELECT * FROM campaigns_images WHERE id = '$bannerid'";
			$result = $this->db->query($sql);
			$rows = $result->fetch();
			$result->closeCursor();
			array_push($campaigns[$n], $rows);
			$sql = "SELECT * FROM campaigns_images WHERE id = '$skyscraperid'";
			$result = $this->db->query($sql);
			$userdetails = $result->fetch();
			
			//var_dump($bannerid);
			//var_dump($skyscraperid);
			//$result->closeCursor();
			//var_dump($rows);
			array_push($campaigns[$n], $userdetails);
			$n++;
		}
	//	var_dump($campaigns);
		return $campaigns;
		
		
	}
	
	public function getImageName($id){
		$sql = "SELECT image_name FROM campaigns_images WHERE id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
	}
	
	function removeCampaign($id){
		
		$sql = "DELETE FROM campaigns WHERE id = '$id'";
		$result = $this->db->query($sql);
		
		
	}
	
	
	
	public function getCampaignById($id){
		
		$sql = "SELECT * FROM campaigns WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
	}
	
public function getCompanyById($id){
		
		$sql = "SELECT * FROM campaigns_companies WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	
	
	public function updateCampaign($data, $campaignId){
		
	//	var_dump($data);
		$title = $data['title'];
		$description = $data['description']; //$data['campaignDescription'];
		$startdate = $data['startdate'];
		$enddate = $data['enddate'];
		$company = $data['company_id'];
		$clickthroughurl = $data['clickthroughurl'];
			$clickthroughurl_B = $data['clickthroughurl_B'];
		$alert_banner = $data['banner_id'];
		$alert_skyscraper = $data['skyscraper_id'];
		//$modifiedby = $data['userid'];
		$useforalerts = $data['useforalerts'];
		$usefornewsletter = $data['usefornewsletter'];
		
		/*var_dump($title);
		var_dump($description);
		var_dump($startdate);
		var_dump($enddate);
		var_dump($company);
		var_dump($clickthroughurl);
		var_dump($alert_banner);
		var_dump($alert_skyscraper);
		var_dump($useforalerts);
		var_dump($usefornewsletter);*/
		
	$sql = "UPDATE campaigns SET title = '$title', description = '$description', startdate = '$startdate', enddate = '$enddate',clickthroughurl = '$clickthroughurl', clickthroughurl_B = '$clickthroughurl_B', company = '$company',banner_id = '$alert_banner', skyscraper = '$alert_skyscraper',useforalerts = '$useforalerts',usefornewsletter = '$usefornewsletter' WHERE id = '$campaignId'";
	//'modifiedby = '$modifiedby',
		$result = $this->db->query($sql);
		//var_dump($data['imagesubs']);
		//if(isset($data['imagesubs']) & count($data['imagesubs']) > 0){
		
	 	// $this->updateImages($data['imagesubs'],$company,$campaignId);
			
		//, description = '$description', startdate = '$startdate', enddate = '$enddate', clickthroughurl = '$clickthroughurl' , company = '$company', banner_id = '$alert_banner', skyscraper = '$alert_skyscraper', $userforalerts = '$useforalerts', usefornewsletter = '$usefornewsletter'		
		
		//}
		
	}
	
public function updateCompany($data, $companyId){
		
		
		
		
		$title = $data['title'];
		
		$sql = "UPDATE campaigns_companies SET companyname = '$title' WHERE id = '$companyId'";
		$result = $this->db->query($sql);
		
		
	}
	
	public function getCompanyFromCampaignId($id){
		$sql = "SELECT company FROM campaigns WHERE id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows; 
	}
	
	public function addImage($imagename,$imagealt, $id){
		$sql = "INSERT INTO campaigns_images (title, alt, campaignid) VALUES ('$imagename','$imagealt','$id')";
		$this->db->query($sql);
		return $this->db->lastInsertId();
		
	}
	
	
	public function insertCampaign($data){
		
//var_dump($data);
		
		$title = $data['title'];
		$description = $data['description']; //$data['campaignDescription'];
		$startdate = $data['startdate'];
		$enddate = $data['enddate'];
		$clickthroughurl = $data['clickthroughurl'];
		$clickthroughurl_B = $data['clickthroughurl_B'];
		$company = $data['company_id'];
			$alert_banner = $data['banner_id'];
		$alert_skyscraper = $data['skyscraper_id'];
		$modifiedbyid = $data['userid'];
		$useforalerts = $data['useforalerts'];
		$usefornewsletter = $data['usefornewsletter'];
		//$imagename = $data['imagename'];
		//$imagealt = $data['imagealt'];
		
		
		
		$sql = "INSERT campaigns (title, description, startdate, enddate,clickthroughurl,clickthroughurl_B, company, banner_id, skyscraper,modifiedbyid,useforalerts,usefornewsletter) VALUES ('$title', '$description', '$startdate', '$enddate','$clickthroughurl','$clickthroughurl_B','$company','$alert_banner', '$alert_skyscraper','$modifiedbyid', '$useforalerts','$usefornewsletter')"; // , modifiedbyid
		//var_dump($sql);
		try{
		$result = $this->db->query($sql);
		$campaignId = $this->db->lastInsertId();
				if(isset($data['imagesubs'])){
					$this->insertImages($data['imagesubs'],$campaignId,$company);
				}
			  	$imgpath = array();
				//$imgpath =  $this->setUpCampaignFolder($campaignId,'32');
				$imgpath['path'] =  $this->setUpCampaignFolder($campaignId,$company);
				$imgpath['campaignid'] = $campaignId;
				//var_dump($imgpath);
				return $imgpath;
		} catch(Zend_Db_Exception $e) {
			return $e;
			//echo $e;
			
		}
		//var_dump($campaignId);
		//var_dump($data['imagesubs']);
		
		
	}
	
	
	
   public function insertCompany($data){
		
		//echo "camp mod";
		
		$companyname = $data['title'];
		$sql = "INSERT campaigns_companies (companyname) VALUES ('$companyname')";
		$result = $this->db->query($sql);
		
		$companyId = $this->db->lastInsertId();
		
		$this->setUpCompany($companyId);
		
		
		
	  	
	}
	
	function getImageById($id){
		
		$sql = "SELECT * FROM campaigns_images WHERE id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
	}
	
	private function setUpCompany($companyId){
		
		// company folder
		$res = mkdir( 'assets/'.$companyId, 0777 );
		$re = chmod( 'assets/'.$companyId, 0777 );
		
		//company images 
		$res = mkdir( 'assets/'.$companyId.'/images', 0777 );
		$re = chmod( 'assets/'.$companyId.'/images', 0777 );
		
		//company images volt 
		$res = mkdir( 'assets/'.$companyId.'/images/volt', 0777 );
		$re = chmod( 'assets/'.$companyId.'/images/volt', 0777 );
		
		//company campaigns
		$res = mkdir( 'assets/'.$companyId.'/campaigns', 0777 );
		$re = chmod( 'assets/'.$companyId.'/campaigns', 0777 );
		

		
	}
	
	public function getImagesForDropDown($id){
	//	$imgs = $this->getImagesByCompany($id);
		$imgs = $this->getImages();
		//var_dump($id);
	//	var_dump($imgs);
		$imgsfordrop = $this->createKeyValuePairs($imgs, 'id','description');
		//var_dump($imgsfordrop);
		return $imgsfordrop;
	}
	
	private function setUpCampaignFolder($campaignId,$companyId){
		
		
		$res = mkdir( 'assets/'.$companyId.'/campaigns/'.$campaignId, 0777 );
		$re = chmod( 'assets/'.$companyId.'/campaigns/'.$campaignId, 0777 );
		$res = mkdir( 'assets/'.$companyId.'/campaigns/'.$campaignId.'/images', 0777 );
		$re = chmod( 'assets/'.$companyId.'/campaigns/'.$campaignId.'/images', 0777 );
		$res = mkdir( 'assets/'.$companyId.'/campaigns/'.$campaignId.'/images/banner', 0777 );
		$re = chmod( 'assets/'.$companyId.'/campaigns/'.$campaignId.'/images/banner', 0777 );

		
		return 'assets/'.$companyId.'/images/volt';
	}
	
	
	private function insertImages($images, $company){
	  //var_dump($images);
		for($i = 1;$i < count($images); $i++){ // 1 becuase of the placement div
			//var_dump($images[$i]);
			
			$this->insertImage($images[$i], $company);
			
		}
	}
	
	public function insertImage($image, $company){
			$image_name = $image['newname']; //.'.gif'; ********************** was good when collecting a new name
			$alt = $image['alt'];
			$description = $image['desc'];
			$sql = "INSERT campaigns_images (image_name, alt, description, company) VALUES ( '$image_name', '$alt', '$description', '$company')";
			$result = $this->db->query($sql);
			//var_dump($result);
	}
	
	private function updateImages($images, $company, $campaignid){
	?><pre>
	<?php //var_dump($images); ?>
	</pre><?php
		for($i = 0;$i < count($images); $i++){
			
			$this->updateImage($image[$i]);
		}
	}
	
	public function updateImage($image){
	//var_dump($image);
		if(isset($image['imageid'])){
				//	var_dump($image);
			
				$imageid = $image['imageid'];
				$alt = $image['alt'];
				$description = $image['description'];
				$sql = "UPDATE campaigns_images SET alt = '$alt' , description = '$description' WHERE id = '$imageid'";
				$result = $this->db->query($sql);
			} elseif(count($image)>1){
				$image_name = $image['title'];
				$alt = $images['alt'];
				$description = $image['description'];
				$sql = "INSERT campaigns_images (image_name, alt, description,campaign_id, company) VALUES ('$image_name', '$alt', '$description', '$campaignid', '$company')";
				$result = $this->db->query($sql);
			}
		
	}
	
	public function getClickThroughsByCampaignById($id){
		$sql = "SELECT COUNT (campaigncode) WHERE campaigncode = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
	}
	
	public function getImageForCampaign($id){
		
		$sql = "SELECT i.title FROM images i, campaigns c WHERE c.id = '$id' AND i.id = c.imageId";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
		
	}
	
	public function getBanner($campaign_id){
		
		$sql = "SELECT c.clickthroughurl, c.clickthroughurl_B, c.company, i.image_name, i.alt FROM campaigns_images as i, campaigns as c WHERE c.id = '$campaign_id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
	}
	
	public function setLive($id){
		
	//	var_dump($id);
		$sql = "UPDATE campaigns SET liveStatus = 1 WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		
		
	}
	
	public function turnOffs(){
		
		$sql = "UPDATE campaigns SET liveStatus = 0" ;
		$result = $this->db->query($sql);
		
		
		
	}
	
	
	
}
