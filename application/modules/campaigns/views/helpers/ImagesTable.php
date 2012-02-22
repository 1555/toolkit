<?php
class Zend_View_Helper_Imagestable extends Zend_View_Helper_Abstract
{
    public function imagestable(){
    	//var_dump($_SERVER);
      $docroot = $_SERVER['HTTP_HOST'];
    	//$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $images = $this->view->content;
      $companies= $this->view->companies;
      //$clickthroughs = $this->view->content;
 	//var_dump($images);
      $imagesArray = $this->object_to_array($images);
      
      $images_table = "<form id='form1' name='form1' method='post' action=$prefix/campaigns/index/updatemultipleimages/>";
      
      $images_table .='<select ONCHANGE="location = this.options[this.selectedIndex].value;">';
      
      $i = 0;
  
      $id = $this->view->id;
      $images_table .="<option >-- choose a company --</option>";
      foreach($companies as $c){
      	$key = array_search($c, $companies);
      //	var_dump($key); 
      	$sel = '';
      	if(isset($id)){
      	if($key == $id){
      		$sel = 'SELECTED';
      	}
      	}
      	$images_table .="<option $sel value=$prefix/campaigns/index/getimagesbycompany/id/$key >$c</option>";
      }
      
     /*while($i < count($companies)){
     	$i++;
      	var_dump($companies[$i]);
      	$images_table .='<option name="">';
      	
      }*/
      
      $images_table .='</select>';
      
      $images_table .='<table id="table">';
      $images_table .='<tr><th>Description</th><th>Thumb</th><th>Edit Details</th><th>Image location (for promos)</th><th>Delete</th></tr>'; 
      $x = 1;
   //  $currentcampaign = $imagesArray[0]['id'];
      foreach($imagesArray as $n){
      	
   	//var_dump($n);
      	$imagesArray = array();
		$imagesArray = $this->object_to_array($n);
		//$id = $imagesArray['id']; 
		$image_id = $imagesArray['id'];
		$title = $imagesArray['image_name'];
		$description = $imagesArray['description'];
	//	$banner_id = $imagesArray['banner_id'];
		//$campaign = $imagesArray['title'];
		//$campaign_id = $imagesArray['campaign_id'];
		$company_id = $imagesArray['company'];
		
	
		
		
	
		
    //  if($x%2){
    
	//if($currentcampaign == $id){
		
	//	$images_table .='<tr class="even">';
		
		//	} else {
				
	//	$currentcampaign = 	$id;
		$images_table .='<tr class="even" >';
					
	//	}
	//	if($image_id == $banner_id){
	//		$checked = 'checked=true';
	//	}	else {
	//		$checked = '';
	//	}
		//$images_table .="<td></td><td><a href='$prefix/assets/$company_id/images/volt/$title' rel='lightbox[roadtrip]'><img rel='lightbox' src='$prefix/assets/$company_id/images/volt/$title' width='100'></a></td><td><input type=checkbox  name=delete_$image_id ></td><td><a href='$prefix/campaigns/index/imageedit/id/$image_id'>Edit Image Info</a><td>http://$docroot$prefix/assets/$company_id/images/volt/$title</td></td>";	
		$images_table .="<td>$description</td><td><a href='$prefix/assets/$company_id/images/volt/$title' class='thickbox'><img rel='lightbox' src='$prefix/assets/$company_id/images/volt/$title' width='100'></a></td><td><a href='$prefix/campaigns/index/imageedit/id/$image_id'>Edit Image Info</a><td>http://$docroot$prefix/assets/$company_id/images/volt/$title</td><td><input type=checkbox  name=delete_$image_id ></td></td>";	
		
		//	$images_table .="<td height='50' >$campaign</td><td>$title</td><td><a href='/tool$prefix/images/$title' rel='lightbox[roadtrip]'><img rel='lightbox' src='/tool$prefix/assets/$company_id/$campaign_id/images/volt/$title' width='200'></a></td><td><input type=radio name=$id $checked value=$image_id></td><td><input type=checkbox  name=delete_$image_id ></td><td><a href='/tool$prefix/campaigns/index/edit/id/$id'>Edit Image Info</a></td>";	
		
		//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$images_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="images/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		$x++;
		
      	
      }
      
      $images_table .='</table>';
	 // $images_table .="<input type='button' name='update' onclick='addShow()' value='Update Screens'>";
	  
      $images_table .= '<input class="button" type="submit" name="Submit" id="Submit" value="Update Images">';
      
      $images_table .='</form>';
		
		 return $images_table;
      
      
      
    
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
