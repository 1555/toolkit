<?php

	

class Newsletters_Model_DbTable_Newsletters{
	
	public $db;
	
	public function __construct(){
	
		
	$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->newsletters->resources->db); 
		
	}
	
	
	
	public function managemultiple(){
		
		
		
	}
	
	public function getAllNewsLetters($order){
		

    //	return 'hi ther';
    	$sql = "SELECT * FROM newsletters ORDER BY date $order";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
    	
    }
	
	public function getCompoundNewsletter($id){
		$newsletter = $this->getNewsletterById($id);
		//var_dump($newsletter);
		$paragraphs =  $this->getParagraphsForANewsletter($id); //array('para1'=>'8');
	//	var_dump($paragraphs);
	$newsletter['banner_b_company_id'] = '79';
		$newsletter['banner_b_campaign_id'] = '2';
		$newsletter['paragraphs'] = $paragraphs;
		return $newsletter;
	}
	
	
	
	public function getNewsletterById($_id){
		$sql = "SELECT * FROM newsletters WHERE id = '$_id'";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		
	}
	
	
	public function getParagraphsForANewsletter($_id){
		
		$sql = "SELECT * FROM newsletter_paragraphs WHERE newsletter_id = '$_id' ORDER BY id";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		
	}
		

	
	
	
	
	
public function insertNewsletter($nl){ 

//var_dump($nl);

$data = array(

		'date'    => $nl['date'],
		'newsletterTitle'    => $nl['newsletterTitle'],
		'newsletterBody'    => $nl['newsletterBody'],
	
		);

		try {
          $this->db->insert('newsletters', $data);
        $nlid = $this->db->lastInsertId();
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
     
	 $this->insertParas($nl['parasubs'],$nlid);
		 
	
	 


}

private function insertParas($paras, $nlid){
	
	//$paras = array_reverse($paras);
	$paras = $paras;
	//var_dump($paras);
	
	for($i = 0;$i<count($paras);$i++){
		$p = $paras['para'.$i];
		//var_dump($p);
		
		if($p['link'] == '<link>'){
			
			$p['link'] = '';
			
		}
		
		if($p['link_text'] == '<link text>'){
			
			$p['link_text'] = '';
			
		}
		
		$data = array(
		
		'h2'=>$p['h2'],
		'p'=>$p['p'],
		'link'=>$p['link'],
		'link_text'=>$p['linktext'],
		'newsletter_id'=>(int)$nlid,
		
		);
		
		//var_dump($p);
		
		try {
          $this->db->insert('newsletter_paragraphs', $data);
       
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
	
	}
	
}
	
	public function duplicateNewsletter($id){
		$sql = "SELECT * FROM newsletters WHERE id = '$id'";
		$result = $this->db->query($sql);
		$row = $result->fetch();
		$result->closeCursor();
		
		$data = array(

		'date'    => $row['date'],
		'banner_a_campaign_id'    => $row ['banner_a_campaign_id'],
		'banner_b_campaign_id'    => $row ['banner_b_campaign_id'],//07973105534
		'banner_a_company'    => $row ['banner_a_company'],
		'banner_b_company'    => $row ['banner_b_company'],
	
		);
		
	try {
          $this->db->insert('alerts', $data);
         $newid = $this->db->lastInsertId();
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
        
        
        $this->duplicateAssociatedInterviews($id, $newid);
        
		
		
	}
	
	private function duplicateAssociatedInterviews($id,$newid){
		
		$sql = "SELECT * FROM alerts_interviews WHERE alert_id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		foreach($rows as $r){
			
			$data = array(
			
			'show_id' => $r['show_id'],
			'guestname' => $r['guestname'],
			'guesttitle' => $r['guesttitle'],
			'companyname' => $r['companyname'],
			'topic' => $r['topic'],
			'alert_id' => $newid,
			'mins' => $r['mins'],
			'hrs' => $r['hrs'],
			'description' => $r['description']);
			
			//$sql = "INSERT INTO alerts_interviews (show_id, guestname, guesttitle, companyname, topic, alert_id, mins, hrs, description) VALUES ('$showid','$guestname','$guesttitle','$companyname','$topic','$alert_id','$mins','$hrs','$description')";
				try {
		          $this->db->insert('alerts_interviews', $data);
		        
		        } catch (Zend_Db_Exception  $e) {
		            cnbc_Log::getLogger()->err($e->getMessage());
		            throw $e;
		        }
		        
		}
		
		
	}
    
    
public function updateNewsletter($nl, $id){ 
//var_dump($nl);
	$data = array(

		'date'    => $nl['date'],
		'newsletterTitle'    => $nl['newsletterTitle'],
		'newsletterBody'    => $nl['newsletterBody'],
	
		);

		try {
            $this->db->update('newsletters', $data, 'id = ' . $this->db->quote((int) $id));
        } catch (Zend_Db_Exception $e) {
          // Filmed_Log::getLogger()->err($e->getMessage());
        throw $e; 
        }
     $this->removeExitingParagrphsByNewsletterId($id);
       $this->insertParas($nl['parasubs'],$id);
        
    }
    
    
   
    
    private function removeExitingParagrphsByNewsletterId($id){
    	
    	$sql = "DELETE FROM newsletter_paragraphs WHERE newsletter_id='$id'";
    	$result = $this->db->query($sql);
		$result->closeCursor();
		//return $rows;
    }
    
    
  
    
    private function getDigClock($h, $m){
    	
    	return $h.':'.$m;
    	
    }
    
    private function getCalenderString($hrs, $mins, $cdate){
    	
   			$alertstart = $cdate.'T'.$hrs.$mins.'00';
   			$end = $this->getEndTime($hrs, $mins);
   			$alertend = $cdate.'T'.$end.'00';
    	
   			$times = array();
   			
   			array_push($times, $alertstart);
   			array_push($times, $alertend);
   			
   			//var_dump($times);
   			
   			return $times;
   			
    	
    }
    
    private function getEndTime($h, $m){
    	
    	if($m < 45){
			$m+=15;
		} elseif($m >= 45){
		 $diff = 60 - $m;
		 $m = 15 - $diff;
		$h+=1;
		$h = (string)'0'.$h;
		}
		

	
	return $h.$m;
    	
    }
    
    private function chopZeros($t){
    	$time = explode(":", $t);
    	
    	//return 
    	
    }
    
    
	private function formatDateForAlert($d){
		
		$date = explode("-", $d);
		
		return $date[0].$date[1].$date[2];  
		
		
	}
    
    private function getTimeString($hrs, $mins, $startend){
	
	
	
	$h = explode(':',$hrs);
	$h = $h[0];
	
	$m = explode(':',$mins);
	$m = $m[0];
	
	if($startend == 'end'){
		
		if($m < 45){
			$m+=15;
		} elseif($m >= 45){
		 $diff = 60 - $m;
		 $m = 15 - $diff;
		$h+=1;
		}
		
	}
	
	return $h.$m;
	
	
}
    
    
   public function getAllShowsForAnAlert($alertid){
    	$sql = "SELECT a_s.description, alerts_shows.title, a_s.guesttitle, a_s.companyname, a_s.topic, a_s.mins, a_s.hrs, a_s.guestname, a_s.guesttitle, a_s.show_id, a_s.id FROM alerts_interviews a_s, alerts_shows where a_s.alert_id = '$alertid' and a_s.show_id = alerts_shows.id";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
    	
    }
    
    public function getAlert($id){
    	//$sql = "SELECT * FROM alerts a, alert_shows ash , shows s  where a.id = '$id' and ash.alert_id = '$id'";
    	$sql = "SELECT * FROM alerts where id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
    	
    	
    }
	
public function getAllAlerts(){ // gets all the polls
	
		$sql = 'SELECT * FROM alerts';
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
	}
	
	public function getAllCampaigns(){
		
		$sql = 'SELECT c.id, i.title as imgTitle, c.title, c.startdate, c.enddate, c.description, c.liveStatus  FROM campaigns c, campaigns_images i WHERE c.imageId = i.id ';
		$result = $this->conn->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	function removeCampaign($id){
		
		$sql = "DELETE FROM campaigns WHERE id = '$id'";
		$result = $this->conn->query($sql);
		
		
	}
	
	public function getGuestsForAnAlert($alertid){
		$sql = "SELECT * FROM alerts_interviews WHERE alert_id = '$alertid'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
	}
	
	public function getAlertById($id){
		$sql = "SELECT * FROM alerts WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
	}
	
	
	public function getCampaignById($id){
		
		$sql = "SELECT * FROM campaigns WHERE id = '$id'" ;
		$result = $this->conn->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	
	
	public function updateCampaign($id, $data){
		
		
		//var_dump($data);
		
		$title = $data['campaignTitle'];
		$description = $data['campaignDescription']; //$data['campaignDescription'];
		$startdate = $data['startpicker'];
		$enddate = $data['endpicker'];
		$clickurl = $data['clickurl'];
		
		$imagename = $data['imagename'];
		$imagealt = $data['imagealt'];
		
		$imageId = $this->addImage($imagename,$imagealt, $id);
		
		//var_dump($id);
		
		//, imageId = '$imageId', description = '$description', startdate = '$startdate', enddate = '$enddate',
		$sql = "UPDATE campaigns SET title = '$title', description = '$description', startdate = '$startdate', enddate = '$enddate', imageId = '$imageId', clickurl = '$clickurl'  WHERE id = '$id'";
		$result = $this->conn->query($sql);
	//	var_dump($result);
		
		
	}
	
	public function addImage($imagename,$imagealt, $id){
		$sql = "INSERT INTO campaigns_images (title, alt, campaignid) VALUES ('$imagename','$imagealt','$id')";
		$this->conn->query($sql);
		return $this->conn->lastInsertId();
		
	}
	
	
	public function createCampaign($data){
		
		
		$title = $data['campaignTitle'];
		$description = $data['campaignDescription']; //$data['campaignDescription'];
		$startdate = $data['startpicker'];
		$enddate = $data['endpicker'];
		$clickurl = $data['clickurl'];
		
		$imagename = $data['imagename'];
		$imagealt = $data['imagealt'];
		
		
		
		$sql = "INSERT campaigns (title, description, startdate, enddate,clickurl) VALUES ('$title', '$description', '$startdate', '$enddate','$clickurl')";
		$result = $this->conn->query($sql);
		
		$campaignId = $this->conn->lastInsertId();
		
		$imageId = $this->addImage($imagename,$imagealt, $campaignId);
		
		$sql = "UPDATE campaigns SET imageid = '$imageId' WHERE id = '$campaignId'";
		
		$result = $this->conn->query($sql);
		
	}
	
public function getAllPromosForDropDown(){
		$promos = $this->getAllPromos();
		$camps = $this->createKeyValuePairs($promos, 'id', 'title');
		//return $campaigns;
		return $camps;
		
		
	}
	
private function createKeyValuePairs($array, $k, $v){
		//$_camps = array($camps[0]['id'] => $camps[0]['title'],$camps[1]['id'] => $camps[1]['title']);
		$_camps = array();
		array_push($_camps, 'please select');
		$n = 0;
		foreach($array as $c){
			//var_dump($c);
			//$_camps[] = array($c['id'] => $c['title']);
			$_camps[$c[$k]] = $c[$v];
			//array_push($_camps, array($c['id'] => $c['title'])); -- good if you need optionGroups
		}
		//array_push($_camps, 'select an image');
		
	return $_camps;
	}
	
	public function getImageForCampaign($id){
		
		$sql = "SELECT i.title FROM campaigns_images i, campaigns c WHERE c.id = '$id' AND i.id = c.imageId";
		$result = $this->conn->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
		
	}
	
	
	
	public function deleteNewsletters($newsletters){
		//var_dump($images);
		while ($on = current($newsletters)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($newsletters));
	       // var_dump($num);
	      $sql = "DELETE FROM newsletters WHERE id = '$id'";
	      
		$result = $this->db->query($sql);
		
		$this->removeAssociatedParagraphs($id);
	    }
    	next($newsletters);
		}
	}
	
	private function removeAssociatedParagraphs($id){
		
		
		$sql = "DELETE FROM newsletter_paragraphs WHERE newsletter_id = '$id'";
	    $result = $this->db->query($sql);
		
		
	}

private function getNum($key){
		return substr($key, 7, strlen($key)-1);
	}
	
	public function setLive($id){
		
		//var_dump($id);
		$sql = "UPDATE campaigns SET liveStatus = 1 WHERE id = '$id'";
		$result = $this->conn->query($sql);
		
		
	}
	
	public function turnOffs(){
		
		$sql = "UPDATE campaigns SET liveStatus = 0";
		$result = $this->conn->query($sql);
		
		
		
	}
	
	
	
}
