<?php
class Zend_View_Helper_Alertstable extends Zend_View_Helper_Abstract
{
    public function alertstable(){
      $alerts = $this->view->content;
      $alertsArray = $this->object_to_array($alerts);
      //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $alerts_table = "<form id='form1' name='form1' method='post' action='$prefix/alerts/index/managemultiple'>";
      $alerts_table .='<table id="table">';
      $alerts_table .='<tr><th>Alert Date</th><th>Preview Alert</th><th>Edit Alert</th><th>Duplicate</th><th>Remove Alert</th></tr>'; 
      $x = 1;
      foreach($alertsArray as $n){
      	
      //	var_dump($n);
      	$alertsArray = array();
		$alertsArray = $this->object_to_array($n);
		$id = $alertsArray['id']; 
		$date = $n['date'];
		//$title = $alertsArray['pollname'];
		//$description = $alertsArray['polldescription'];
		//$question = $alertsArray['pollquestion'];
		//$createddate = $alertsArray['datecreated'];
		//$Dolby = $alertsArray['sr_dolby'];
		//$Wheelchair = $alertsArray['sr_whlchr_qty'];
//		
//var_dump($alertsArray);
      if($x%2){
			
$alerts_table .='<tr class="even">';	
		
			} else {
			
$alerts_table .='<tr class="odd">';
					
			}
		$alerts_table .="<td>$date</td><td><a href='$prefix/alerts/index/preview/id/$id'>Preview Alert</a></td><td><a href='$prefix/alerts/index/edit/id/$id'>Edit Alert</a></td><td><a href='$prefix/alerts/index/duplicate/id/$id'>Duplicate Alert</a></td><td><input type=checkbox  name=delete_$id ></td></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$alerts_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="alerts/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $alerts_table .='</table>';
	 $alerts_table .="<input class='button' type='submit' name='update' value='Update Alerts'>";
	  $alerts_table .='</form>';
		
		 return $alerts_table;
      
      
      
    
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
