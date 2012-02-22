<?php

	

class Admin_Model_DbTable_Admins{
	
	public $db;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->admin->resources->db); 
		
	}
	
	
	
public function deleteAdmins($admins){
		
		while ($on = current($admins)){
	
	    if ($on == 'on') {
	     
	      $id= $this->getNum(key($admins));
	      $sql = "DELETE FROM admin_users WHERE id = '$id'";
		$result = $this->db->query($sql);
	    }
    	next($admins);
		}
	}
	
	public function insertUser($user){
		$data = array(
		
				'firstname'    => $user['firstname'],
				'surname'    =>$user['surname'],
				'emailaddress'    => $user['emailaddress'],
				'telephone'    => $user['telephone'],
				'streetaddress'    => $user['streetaddress'],
				'city'    => $user['city'],
				'postcode'    => $user['postcode'],
		
		);
		
		
		 
		try {
			$this->db->insert('users', $data);
			$id = $this->db->lastInsertId();
		
		} catch (Zend_Db_Exception  $e) {
			cnbc_Log::getLogger()->err($e->getMessage());
			throw $e;
		}
		if(isset($id)){
			$this->sendEmail($admin);
		}
		
		}
		
	
	

	
public function insertAdmin($admin){ 
	
	
   $admin['username'] = $this->generateUsername($admin['lastname'],$admin['sso']);
	$admin['password'] = $this->generatePassword(9,8);
   $data = array(

		'username'    => $admin['username'],
		'password'    => $admin['password'],
   		'sso'    => $admin['sso'],
		'role'    => $admin['role'],
		'firstname'    => $admin['firstname'],
		'lastname'    => $admin['lastname'],
		'email'    => $admin['email'],
		
		);
   
     try {
            $this->db->insert('admin_users', $data);
            $id = $this->db->lastInsertId();
            
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        }
       if(isset($id)){
       	$this->sendEmail($admin);
       }
        
    }
    
    public function getAdminsBy($filter, $dir){
    		
    		$sql = "SELECT * FROM admin_users ORDER BY $filter $dir"; //'$dir'
    		$result = $this->db->query($sql);
    		$rows = $result->fetchAll();
			$result->closeCursor();
			return $rows;
    	
    
    }
    
    private function sendEmail($admin){
    	$first = $admin['firstname'];
    	if($admin['lastname'] !== undefined){
    		$last = $admin['surname'];
    	}
    	
    	$last = $admin['lastname'];
    	$to = "edward.hunton@cnbc.com";
    	//$to = $admin['email'];
    	$from = "edward.hunton@cnbc.com";
    	$subject = "CNBC Toolkit account";
    	$body = "hi there";
    	$headers =  'from: edward.hunton@cnbc.com';
    	mail($to, $subject, $body, $headers);
    }
    
    private function getNum($key){
    	return substr($key, 7, strlen($key)-1);
    }
    
private function generatePassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
    
    
    
    private function generateUsername($last, $sso){
    	return substr($last, 0, 3).$sso;
    }
    
public function updateAdmin($admin, $id){ 
	
	
	$data = array(

		
		'role'    => $admin['role'],
		'firstname'    => $admin['firstname'],
		'lastname'    => $admin['lastname'],
		'email'    => $admin['email'],
		
		);
		try {
            $this->db->update('admin_users', $data, 'id = ' . $this->db->quote((int) $id));
        } catch (Zend_Db_Exception $e) {
           cnbc_Log::getLogger()->err($e->getMessage());
        throw $e; 
        }
       
    }
    
   private function getUsernameFromPassword($password){
    	
    	$sql = "SELECT id FROM alerts_shows where title = '$password'";
    	$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
    	
    }
    
  private function getPasswordFromUsername($username){
    	//var_dump($showTitle);
    	$sql = "SELECT id FROM alerts_shows where title = '$username'";
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
    	
    		$shows[$n]['calstring'] = $this->getCalenderString($s['interview_start_hrs'], $s['interview_start_mins'],$date);
    		$shows[$n]['starttime'] = $this->getDigClock($s['interview_start_hrs'],$s['interview_start_mins']);
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
    		$alertstart = $cdate.'T'.$hrs.$mins.'00';
   			$end = $this->getEndTime($hrs, $mins);
   			$alertend = $cdate.'T'.$end.'00';
    	
   			$times = array();
   			
   			array_push($times, $alertstart);
   			array_push($times, $alertend);
   			
   			return $times;
   			
    	
    }
    
    private function getEndTime($h, $m){
    	
    	if($m < 45){
			$m+=15;
		} elseif($m >= 45){
		 $diff = 60 - $m;
		 $m = 15 - $diff;
		$h+=1;
		}
		

	
	return $h.$m;
    	
    }
    
    private function chopZeros($t){
    	$time = explode(":", $t);
    	
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
    	$sql = "SELECT a_s.description, alerts_shows.title, a_s.guesttitle, a_s.companyname, a_s.topic, a_s.interview_start_mins, a_s.interview_start_hrs, a_s.guestname, a_s.guesttitle, a_s.show_id FROM alerts_interviews a_s, alerts_shows where a_s.alert_id = '$alertid' and a_s.show_id = shows.id";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
    	
    }
    
    public function getAlert($id){
    	$sql = "SELECT * FROM alerts_shows where id = '$id'";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
    	
    	
    }
	
public function getAllAdmins(){ 
	
		$sql = 'SELECT * FROM admin_users';
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		
		return $rows;
	}
	
	public function getAllCampaigns(){
		
		$sql = 'SELECT c.id, i.title as imgTitle, c.title, c.startdate, c.enddate, c.description, c.liveStatus  FROM campaigns c, campaigns_images i WHERE c.imageId = i.id ';
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	function removeCampaign($id){
		
		$sql = "DELETE FROM campaigns WHERE id = '$id'";
		$result = $this->db->query($sql);
		
		
	}
	
	public function getGuestsForAnAlert($alertid){
		$sql = "SELECT * FROM alerts_interviews WHERE alert_id = '$alertid'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
	}
	
	public function getAdminById($id){
		$sql = "SELECT * FROM admin_users WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
	}
	
	
	public function getCampaignById($id){
		
		$sql = "SELECT * FROM campaigns WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
	}
	
	
	
	public function updateCampaign($id, $data){
		
		
		$title = $data['campaignTitle'];
		$description = $data['campaignDescription']; 
		$startdate = $data['startpicker'];
		$enddate = $data['endpicker'];
		$clickurl = $data['clickurl'];
		$imagename = $data['imagename'];
		$imagealt = $data['imagealt'];
		$imageId = $this->addImage($imagename,$imagealt, $id);
		$sql = "UPDATE campaigns SET title = '$title', description = '$description', startdate = '$startdate', enddate = '$enddate', imageId = '$imageId', clickurl = '$clickurl'  WHERE id = '$id'";
		$result = $this->db->query($sql);
		
		
	}
	
	public function addImage($imagename,$imagealt, $id){
		$sql = "INSERT INTO campaigns_images (title, alt, campaignid) VALUES ('$imagename','$imagealt','$id')";
		$this->conn->query($sql);
		return $this->db->lastInsertId();
		
	}
	
	
	public function createUser($data){
		
		
		$firstname = $data['firstname'];
		$lastname = $data['lastname']; //$data['campaignDescription'];
		$email= $data['email'];
		$role= $data['role'];
		$username=  $data['firstname'];
		$password=  $data['firstname'];
		
		
		$sql = "INSERT admin_users (username, password, role, firstname,lastname, email) VALUES ('$username', '$password', '$role', '$firstname','$lastname', '$email')";
		$result = $this->db->query($sql);
		
		
		
	}
	
	
	
	public function getImageForCampaign($id){
		
		$sql = "SELECT i.title FROM campaigns_images i, campaigns c WHERE c.id = '$id' AND i.id = c.imageId";
		$result = $this->db->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
		
		
		
	}
	
	public function setLive($id){
		
		$sql = "UPDATE campaigns SET liveStatus = 1 WHERE id = '$id'" ;
		$result = $this->db->query($sql);
		
		
	}
	
	public function turnOffs(){
		
		$sql = "UPDATE campaigns SET liveStatus = 0";
		$result = $this->db->query($sql);
		
		
		
	}
	
	
	
}
