<?php

	

class Default_Model_DbTable_Admin{
	
	public $db;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->default->resources->db); 
		
	}
	
	public function getPasswordViaUsername($_uname, $_email){
		//$_uname = 'ed';
	//	$email = 'edward.hunton@cnbc.com';
		//var_dump($_uname);
		//var_dump($_email);
		$sql = "SELECT password FROM admin_users WHERE username = '$_uname' AND email = '$_email'";
		$result = $this->db->query($sql);
    	$rows = $result->fetch();
		$result->closeCursor();
		//var_dump($rows);
		return $rows;
		//return $rows;
	}
	
	
	public function getUsernameViaPassword($_pword, $_email){
		//var_dump($_pword);
	//	var_dump($_email);
		$sql = "SELECT username FROM admin_users WHERE password = '$_pword' AND email = '$_email'";
		$result = $this->db->query($sql);
    	$rows = $result->fetch();
		$result->closeCursor();
		//return 'nutjob';
		return $rows;
		
		
		
	}
	
	
	
	
}
