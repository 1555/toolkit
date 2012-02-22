<?php
class Zend_View_Helper_Newslettertable extends Zend_View_Helper_Abstract
{
    public function newslettertable(){
      $newsletters = $this->view->content;
      $newslettersArray = $this->object_to_array($newsletters);
     //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $newsletters_table = "<form id='form1' name='form1' method='post' action='$prefix/newsletters/index/managemultiple'>";
      $newsletters_table .='<table id="table">';
      $newsletters_table .="<tr><th>Title</th><th>Date <a href='$prefix/newsletters/index/index/order/ASC'>ASC</a> | <a href='$prefix/newsletters/index/index/order/DESC'>DESC</a></th><th>Preview</th><th>Edit</th><th>Duplicate</th><th>Click Throughs</th><th>Remove</th></tr>"; 
      $x = 1;
      foreach($newslettersArray as $n){
      	
      	//var_dump($n);
      	$newslettersArray = array();
		$newslettersArray = $this->object_to_array($n);
		$id = $newslettersArray['id']; 
		$date = $n['date'];
		$title = $n['newsletterTitle'];
		$clicks = 0; //$n['clicks'];
		//$title = $newslettersArray['pollname'];
		//$description = $newslettersArray['polldescription'];
		//$question = $newslettersArray['pollquestion'];
		//$createddate = $newslettersArray['datecreated'];
		//$Dolby = $newslettersArray['sr_dolby'];
		//$Wheelchair = $newslettersArray['sr_whlchr_qty'];
//		
//var_dump($newslettersArray);
      if($x%2){
			
$newsletters_table .='<tr class="even">';	
		
			} else {
			
$newsletters_table .='<tr class="odd">';
					
			}
		$newsletters_table .="<td>$title</td><td>$date</td><td><a href='$prefix/newsletters/index/preview/id/$id'>Preview</a></td><td><a href='$prefix/newsletters/index/edit/id/$id'>Edit</a></td><td><a href='$prefix/newsletters/index/duplicate/id/$id'>Duplicate</a></td><td>$clicks</td><td><input type=checkbox  name=delete_$id ></td></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$newsletters_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="newsletters/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $newsletters_table .='</table>';
	 $newsletters_table .="<input class='button' type='submit' name='update' value='Update newsletters'>";
	  $newsletters_table .='</form>';
		
		 return $newsletters_table;
      
      
      
    
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
