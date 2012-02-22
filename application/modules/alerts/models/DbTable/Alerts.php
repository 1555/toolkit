<?php

	

class Alerts_Model_DbTable_Alerts{
	
	public $db;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->alerts->resources->db); 
		
	}
	
	public function getAlertNames(){
		//$this->db = cnbc_Db::getAdapter(); 
		$select = $this->db->select();
        $select->from('testers', array('name'));
			   
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
	
	public function getLastSkyscapperId(){
		
	$sql = "SELECT max(id) FROM alerts";
	$result = $this->db->query($sql);
    $rows = $result->fetch();
	$id = $rows["max(id)"];
	$sql = "SELECT banner_b_campaign_id FROM alerts where id = $id";
	$result = $this->db->query($sql);
    $rows = $result->fetch();
	
	$result->closeCursor();
	//return  $rows ;
	return $rows;
		
		
      /* $select->from('alerts', array('banner_b_campaign_id'))->where(MAX('id'));
		
		try {
            $this->db->setFetchMode(Zend_Db::FETCH_OBJ);
            $result = $this->db->fetchCol($select);
        } catch (Zend_Db_Exception $e) {
            //Filmed_Log::getLogger()->err($e->getMessage());
            throw $e;
        }*/
		//var_dump($select);
		//return $result;
		
	}
	
	public function managemultiple(){
		
		
		
	}
	
	public function getRss(){

		$xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
		
		//http://search.cnbc.com/main.do?output=xml&keywords=Employmen
		
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($xml);
		
		return $xmlDoc;
//echo $xmlDoc;

	}
	
	public function getCompanyByCampaignId($id){
		$sql = "SELECT company FROM campaigns WHERE id = '$id'";
		$result = $this->db->query($sql);
    	$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
	}
	
public function insertAlert($alert){ 
	
	// will have to branch out and insert shows
//var_dump($alert);
	if(isset($alert['type_id'])){
		if($alert['type_id']== 'addp'){
		$pId = 	$this->insertPromo($alert);
		} elseif($alert['type_id']== 'updatep'){
			$this->updatePromoItems($alert['promotitle'],$alert['promoBod'], $alert['promoValue']);
		}
	}
	if($alert['promo_select'] != '0'){
		$pId = $alert['promo_select'];
	}
	
	$data = array(

		'date'    => $alert['date'],
	'promo_id' => $alert['promoValue'],
		'banner_a_campaign_id'    => $alert['banner_a_campaign_id'],
		'banner_b_campaign_id'    => $alert['banner_b_campaign_id'],
		'banner_a_company'    => $alert['banner_a_company'],
		'banner_b_company'    => $alert['banner_b_company'],
		'promo_id' => $pId,
	
		);

 	
 	//var_dump($data);
 	
    try {
          $this->db->insert('alerts', $data);
         $id = $this->db->lastInsertId();
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
        if(isset($id) && isset($alert['showssubs'])){
        	$this->insertShows($alert['showssubs'],$id); 
        }
        //return $id;
    }
    
public function updateAlert($alert, $id){ 
	//var_dump($id);
	// will have to branch out and insert shows
	?> <pre>
    <?php  //var_dump($alert); ?>
    </pre>
    <?php  
	$data = array(

		'date'    => $alert['date'],
		'promo_id' => $alert['promo_select'],
		'banner_a_campaign_id'    => $alert['banner_a_campaign_id'],
		'banner_b_campaign_id'    => $alert['banner_b_campaign_id'],
		
	
		);

 	
 	
 	
		try {
            $this->db->update('alerts', $data, 'id = ' . $this->db->quote((int) $id));
        } catch (Zend_Db_Exception $e) {
          // Filmed_Log::getLogger()->err($e->getMessage());
        throw $e; 
        }
        $this->removeExitingShowsByAlertId($id);
        $this->insertShows($alert['showssubs'],$id);
        if($alert['type_id'] == 'addp'){
        	$this->insertPromoItems($alert['promotitle'],$alert['promoBod']);
        }elseif($alert['type_id'] == 'updatep'){
        	$this->updatePromoItems($alert['promotitle'],$alert['promoBod'], $alert['promoValue']);
        }
        //return $id;
    }
    
    
    public function updatePromoItems($_title, $_content, $id){
    
    	$data = array(
    	
    	'title' => $_title,
    	'content' => $_content
    	
    	);
    	
    	try {
            $this->db->update('campaigns_promos', $data, 'id = ' . $this->db->quote((int) $id));
        } catch (Zend_Db_Exception $e) {
          // Filmed_Log::getLogger()->err($e->getMessage());
        throw $e; 
        }
    }
    
    public function insertPromoItems($_title, $_body){
    	
    	$data = array(
    	
    	'title' => $_title,
    	'content'=> $_body
    	
    	);
    	
    try {
           $this->db->insert('campaigns_promos', $data);
        } catch (Zend_Db_Exception $e) {
          // Filmed_Log::getLogger()->err($e->getMessage());
        throw $e; 
        }
    	
    }
    
    public function getAllPromos(){
    	
    	$sql = "SELECT * FROM campaigns_promos";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
    	
    }
    
public function insertPromo($promo){
	
	$data = array(

		
    	'title'    => $promo['promotitle'],
    	'content'    => $promo['promoBod'],
    	
    	);
    	
  //  var_dump($promo['promoBod']);
    	
		try {
            $this->db->insert('campaigns_promos', $data);
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
    	
    	return $this->db->lastInsertId();
    }
    
    public function getPromo($id){
    	
    	//$sql = "SELECT * FROM campaigns_promos WHERE id='$id'";
			$sql = "SELECT * FROM campaigns_promos p, campaigns_images i WHERE p.image_id = i.id and p.id = '$id'";
    	$result = $this->db->query($sql);
    	$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
    	
    	
    	
    }
    
    private function removeExitingShowsByAlertId($id){
    	
    	$sql = "DELETE FROM alerts_interviews WHERE alert_id='$id'";
    	$result = $this->db->query($sql);
		$result->closeCursor();
		//return $rows;
    }
    
    
    private function insertShows($shows_first, $aid){
    //	echo "before shows";
	
    	$shows = array_values($shows_first);
		
		//var_dump($shows[5]);
		

    	for($i = 0;$i < count($shows); $i++){
    		//var_dump($shows['guest'.$i]);
    		//echo "sdfsdf";
    		$sid = $this->getShowIdFromShowString($shows[$i]['show_id']);
    		//var_dump($shows['guest'.$i]['show_id']);
    		$sid = (int)$sid['id'];
    		//var_dump($aid);
    	//	var_dump($sid);
    		//$int = (int)$shows['guest'.$i]['show_id'];
    	//if(is_int($int)){
    	//	echo "not int";
    		//$shows['guest'.$i]['show_id'] = $sid['id'];
    	//}
    	$data = array(

		'alert_id'    => $aid,
    	'show_id'    => $sid,
    	//'show_id'    => $shows['guest'.$i]['show_id'],
    	'guestname'    => $shows[$i]['guestname'],
    	'guesttitle'    => $shows[$i]['guesttitle'],
    	'companyname'    => $shows[$i]['companyname'],
    	'description'    => $shows[$i]['description'],
    	'mins'    => $shows[$i]['mins'],
    	'hrs'    => $shows[$i]['hrs'],
    	'topic'    => $shows[$i]['topic'],
    	
    	
    	);

 	
 	
 	
     try {
            $this->db->insert('alerts_interviews', $data);
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
    	}
    	
    }
    
    private function getShowIdFromShowString($showTitle){
    	//var_dump($showTitle);
    	$sql = "SELECT id FROM alerts_shows where title = '$showTitle'";
    	$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
    	
    }
    
    public function getAllShowForAnAlertWithStartAndEndTimesForCalender($alertid, $date){
    	$shows = $this->getAllShowsForAnAlert($alertid);
    	
    	$date = $this->formatDateForAlert($date);
    	$n = 0;
    	foreach($shows as $s){
    	
    		$shows[$n]['calstring'] = $this->getCalenderString($s['hrs'], $s['mins'],$date);
    		$shows[$n]['starttime'] = $this->getDigClock($s['hrs'],$s['mins']);
    		//var_dump($s);
    		$n++;
    		//echo "ksjfhsdjfh";
    		
    	}
    //	var_dump($shows);
    	return $shows;
    	
    }
    
    private function getDigClock($h, $m){
    	
    	return $h.':'.$m;
    	
    }
    
    private function getCalenderString($hrs, $mins, $cdate){
    		//var_dump($hrs, $min, $cdate);
    		
    		//$stime = $this->chopZeros($stime);
    		//$etime = $this->chopZeros($etime);
    		
    		//$starttimestring = getTimeString($_POST['hrs'.$i], $_POST['mins'.$i], 'start');
    		///$starttimestring = $this->getTimeString('19', '45', 'start');
   			//$endtimestring = getTimeString($_POST['hrs'.$i], $_POST['mins'.$i], 'end');
   			//$endtimestring = $this->getTimeString('20', '30', 'end');
   	
   		//	$alertstart = $cdate.'T'.$starttimestring.'00';
   		//	$alertend = $cdate.'T'.$endtimestring.'00';
   			
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
	
	public function duplicateAlert($id){
		$sql = "SELECT * FROM alerts WHERE id = '$id'";
		$result = $this->db->query($sql);
		$row = $result->fetch();
		$result->closeCursor();
		
		$data = array(

		'date'    => $row['date'],
		'banner_a_campaign_id'    => $row ['banner_a_campaign_id'],
		'banner_b_campaign_id'    => $row ['banner_b_campaign_id'],
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
	
	public function deleteAlerts($alerts){
		//var_dump($images);
		while ($on = current($alerts)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($alerts));
	       // var_dump($num);
	      $sql = "DELETE FROM alerts WHERE id = '$id'";
	      
		$result = $this->db->query($sql);
		
		$this->removeAssociatedInterviews($id);
	    }
    	next($alerts);
		}
	}
	
	private function removeAssociatedInterviews($id){
		
		
		$sql = "DELETE FROM alerts_interviews WHERE alert_id = '$id'";
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
