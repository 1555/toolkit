<?php
class Zend_View_Helper_Indexxml extends Zend_View_Helper_Abstract
{
    public function Indexxml(){
      $stocks = $this->view->content;
	  $index = $this->view->index;
	  
      $stocksArray = $this->object_to_array($stocks);
      $xml = "";
      $xml .= "<?xml version='1.0' encoding='UTF-8'?><category><displayname><![CDATA[$index]]></displayname><stocks>";
	  
	
     // $x = 1;
      foreach($stocksArray as $n){
      	
      //	echo 'bang';
      	$stocksArray = array();
		$stocksArray = $this->object_to_array($n);
		$id = $stocksArray['id']; 
		$name = $stocksArray['displayname'];
		$symbol = $stocksArray['symbol'];
		$hot = $stocksArray['hot'];
		$index = $stocksArray['index'];
		$usedisplayname = $stocksArray['usedisplayname'];
	
			
			
			$xml .= "<stock hot='$hot' usedisplayname='$usedisplayname'><displayname><![CDATA[$name]]></displayname><symbol><![CDATA[$symbol]]></symbol></stock>";
	
			
		
		
      	
      };
      
      $xml .="</stocks></category>";
	  
	// var_dump($xml);
	 //  return 'hi there';
	 return $xml;
      
      
      
    
    }
      
      


	
    private function object_to_array($data) {
		
		  if(is_array($data) || is_object($data)) {
			$result = array(); 
			foreach($data as $key => $value)
			{ 
			  $result[$key] = $this->object_to_array($value); 
			}
			return $result;
		  }
		  return $data;
		}

}
