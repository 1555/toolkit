<?php
class Zend_View_Helper_stockstable extends Zend_View_Helper_Abstract
{
    public function stockstable(){
      $stocks = $this->view->content;
      $stocksArray = $this->object_to_array($stocks);
      //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $stocks_table = "<form id='form1' name='form1' method='post' action='$prefix/stocks/index/managemultiple'>";
      $stocks_table .='<table id="stocks_table">';
      $stocks_table .='<tr><th>Index</th><th>Stock Name</th><th>Stock Symbol</th><th>Hot</th><th>Use Displayname</th><th>Edit</th><th>Remove</th></tr>'; 
      $x = 1;
      foreach($stocksArray as $n){
      	
      	//var_dump($n);
      	$stocksArray = array();
		$stocksArray = $this->object_to_array($n);
		$id = $stocksArray['id']; 
		$name = $stocksArray['displayname'];
		$symbol = $stocksArray['symbol'];
		$hot = $stocksArray['hot'];
		$index = $stocksArray['stockindex'];
		$usedisplayname = $stocksArray['usedisplayname'];
		
      if($x%2){
			
$stocks_table .='<tr class="even">';	
		
			} else {
			
$stocks_table .='<tr class="odd">';
					
			}
			
			if($hot == 'true'){
				$checked = 'CHECKED';
			}else {
				
				$checked = '';
			}
			
	$stocks_table .='<td>'. $index .'</td><td>'. $name .'</td><td>'. $symbol .'</td><td><input type="checkbox"'.$checked.'/></td><td>'. $usedisplayname .'</td><td></td><td></td>
			<td><a href="'.$prefix.'/stocks/index/edit/id/'.$id.'">edit</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $stocks_table .='</table>';
	  $stocks_table .='<input type="submit" name="update" value="Update Stocks" />';
	  $stocks_table .='</form>';
		
		 return $stocks_table;
      
      
      
    
    }
      
      
//	   $this->object_to_array($topics);
//	  
//	//  echo("wommbats");
//	 //fdfgdgdfgdfdfg
//	
//	   $urlHome = $this->view->urlHome;
//	   
//		$topicsListings = '<form id="form1" name="form1" method="post" action="'.$urlHome .'/topics/managemultiple">';
//		$topicsListings .='<table id="topicsstable">';
//			$topicsListings .='<tr><th>Title</th><th>Level</th><th>Delete</th></tr><pre>';
//$x = 1;
//		foreach($topics as $i){
//			$topicArray = array();
//			$topicArray = $this->object_to_array($i);
//			$id = $topicArray['topic_id']; 
//			$title = $topicArray['topic_title'];
//			
//			$level = $topicArray['topic_level'];
//			$img = $topicArray['topic_image'];
//		
////var_dump($topicArray);
//	
//			
//			$topicsListings .='<tr class="even">
//			<td>'. $title .'</td><td>'. $level .'</td><td><input name="remove'.$id. '" type="checkbox" value="remove'.$id. '"  /></td>
//			<td><a href="' . $urlHome . '/topics/edit/id/'.$id.'">edit</a></td></tr>';
//			
//		$x++;
//		}
//		
//		$topicsListings .='</table>';
//		
//		$topicsListings .='<input type="submit" name="update" value="Update Topics Objects" />';
//		
//		$topicsListings .='</form>';
//		
//		 return $topicsListings;

	
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
