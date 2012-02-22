<?php

	

class Alerts_Model_DbTable_Promos{
	
	public $db;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->alerts->resources->db); 
		
	}
	
	
	
	public function managemultiple(){
		
		
		
	}
	
	
	
	
	
	
public function insertPromo($promo){ 
	
//	var_dump($promo);
	
	$data = array(

		//'date'=> $promo['date'],
		'title'=> $promo['promotitle'],
		'content'=> $promo['promocontent'],
		'image_id'=> $promo['image_id'],
		'link'=> $promo['link'],
		
	
	
		);

 	
 	//var_dump($data);
 	
   try {
          $this->db->insert('campaigns_promos', $data);
        
        } catch (Zend_Db_Exception  $e) {
            cnbc_Log::getLogger()->err($e->getMessage());
            throw $e;
        } 
       
    }
    
public function updatePromo($promo, $id){ 
	
	//var_dump($promo);
	$data = array(

		//'date'=> $promo['date'],
		'title'=> $promo['promotitle'],
		'content'=> $promo['promocontent'],
		'image_id'=> $promo['image_id'],
		'link'=> $promo['link'],
		
	
	
		);

 	
 	
 	
		try {
            $this->db->update('campaigns_promos', $data, 'id = ' . $this->db->quote((int) $id));
        } catch (Zend_Db_Exception $e) {
       
        throw $e; 
        }
        

    }
    
   public function getAllPromos(){
    	
    	$sql = "SELECT p.id as promoid, p.title, p.content, p.link, p.date, i.image_name, i.company FROM campaigns_promos p, campaigns_images i WHERE p.image_id = i.id";
    	$result = $this->db->query($sql);
		$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
    	
    }
    

    
    public function getPromo($id){
    	
    	$sql = "SELECT * FROM campaigns_promos WHERE id='$id'";
    	$result = $this->db->query($sql);
    	$rows = $result->fetch();
		$result->closeCursor();
		return $rows;
    	
    	
    	
    }
    
   
    
   
	
	public function deletePromos($promos){
		//var_dump($images);
		while ($on = current($promos)) {
		//var_dump($images);
	    if ($on == 'on') {
	       // echo key($images).'<br />';
	        $id= $this->getNum(key($promos));
	       // var_dump($num);
	      $sql = "DELETE FROM campaigns_promos WHERE id = '$id'";
	      
		$result = $this->db->query($sql);
		
		
	    }
    	next($promos);
		}
	}
	
	
	private function getNum($key){
		return substr($key, 7, strlen($key)-1);
	}
	

	
	
	
}
