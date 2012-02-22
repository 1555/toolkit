<?php
class Zend_View_Helper_Promotable extends Zend_View_Helper_Abstract
{
    public function promotable(){
      $promos= $this->view->content;
      $promosArray = $this->object_to_array($promos);
     //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $promos_table = "<form id='form1' name='form1' method='post' action='$prefix/alerts/index/promosmanagemultiple'>";
      $promos_table .='<table id="table">';
      $promos_table .='<tr><th>Promo Date</th><th>Preview Promo</th><th>Edit Promo</th><th>title</th><th>image</th><th>text</th><th>link</th><th>Remove Promo</th></tr>'; 
      $x = 1;
      foreach($promosArray as $n){
    
      	$promosArray = array();
		$promosArray = $this->object_to_array($n);
		$id = $promosArray['promoid']; 
		$date = $n['date'];
		$title = $promosArray['title'];
		$content = $promosArray['content'];
		$link = $promosArray['link'];
		$src = "http://toolkit.cnbceuropeshared.com/public/assets/".$promosArray['company']."/images/volt/".$promosArray['image_name'];
	//	 var_dump($src);
		//$description = $promosArray['polldescription'];
		//$question = $promosArray['pollquestion'];
		//$createddate = $promosArray['datecreated'];
		//$Dolby = $promosArray['sr_dolby'];
		//$Wheelchair = $promosArray['sr_whlchr_qty'];
//		
//var_dump($promosArray);
      if($x%2){
			
$promos_table .='<tr class="even">';	
		
			} else {
			
$promos_table .='<tr class="odd">';
					
			}
		$promos_table .="<td>$date</td><td>Preview Promo (coming soon!)</td><td><a href='$prefix/alerts/index/editpromo/id/$id'>Edit Promo</a></td><td>$title</td><td><img src='$src'></td><td>$content</td><td><a href='$link'>$link</a></td><td><input type=checkbox  name=delete_$id ></td></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$promos_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="promos/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $promos_table .='</table>';
	 $promos_table .="<input class='button' type='submit' name='update' value='Update Promos'>";
	  $promos_table .='</form>';
		
		 return $promos_table;
      
      
      
    
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
