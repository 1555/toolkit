<?php



class Stocks_Model_DbTable_Stocks extends Zend_Db_Table_Abstract
{
public $db;
public $conn;
	
	public function __construct(){
	
		
		$this->db = cnbc_Db::getAdapter(Zend_Registry::get('config')->stocks->resources->db); 
		
	}
	
	public function getAllStocks(){
		
		$sql = "SELECT * FROM INDEXS";
		$result = $this->db->query($sql);
    	$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		//return "hithere";
		
		
	}
	
	// get all stocks by index
	public function getAllStocksByIndex($index){
		
		$sql = "SELECT * FROM INDEXS WHERE stockindex = '$index'";
		$result = $this->db->query($sql);
    	$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		//return "hithere";
		
		
	}
	
	public function getStockById($id){
		
		$sql = "SELECT * FROM INDEXS WHERE id = '$id'";
		$result = $this->db->query($sql);
    	$rows = $result->fetchAll();
		$result->closeCursor();
		return $rows;
		//return "hithere";
		
		
	}
	
	// add manhy stocks
	
	public function insertStocks($stocks){
		// var_dump($stocks);
		$this->inStocks(array($stocks['stocksubs']));
	}
	
	private function inStocks($stocks){
	var_dump($stocks);
	//var_dump(count($stocks));
		for($i = 0;$i < count($stocks[0]); $i++){ // 1 becuase of the placement div
			//var_dump($stocks[0][$i]);
			
			$this->insertStock($stocks[0][$i+1]);
			
		}
	}
	
	public function insertStock($stock){
		
	
		echo "bang";
		
		$data = array(
		
		'displayname' => $stock['displayname'],
		'symbol' => $stock['symbol'],
		'stockindex' => $stock['index'],
		
		);
		//var_dump($data);
			
			try {
            $this->db->insert('INDEXS', $data);
        } catch (Zend_Db_Exception  $e) {
			
			echo "either the symbol or the displayname allready exists";
			//echo "<a href=''>back</a>";
            //cnbc_Log::getLogger()->err($e->getMessage());
            //throw $e;
        }
    	
			
			//$sql = "INSERT INDEXS (displayname, symbol, index) VALUES ( '$displayname', '$symbol', '$index')";
		//	$result = $this->db->query($sql);
			//var_dump($result);
	}
	// get single stock
	
	// add stock (to an index)
	
	// remove stock (from an index)
	
	
}
