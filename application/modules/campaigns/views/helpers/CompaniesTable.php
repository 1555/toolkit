<?php
class Zend_View_Helper_CompaniesTable extends Zend_View_Helper_Abstract
{
    public function companiestable(){
      
     //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
      $companies = $this->view->content;
      //$clickthroughs = $this->view->content;
      $companiesArray = $this->object_to_array($companies);
      
      $companies_table = "<form id='form1' name='form1' method='post' action='$prefix/campaigns/index/updatemultiplecompanies'>";
      $companies_table .='<table id="table" >';
      $companies_table .="<tr><th><a href='$prefix/campaigns/index/filterby/filter/title'>Company Name</a></th><th>Total Campaigns</th><th>Total click throughs</th><th>Generate report</th><th>Create a Campaign</th><th>Add Images for Company</th><th>View Images for Company</th><th>Remove Company</th></tr>"; 
      $x = 1;
      if(count($companiesArray) > 0){
      $currentcampaign = $companiesArray[0]['id'];
      foreach($companiesArray as $n){
      	
    	//var_dump($n);
      	$companiesArray = array();
		$companiesArray = $this->object_to_array($n);
		$id = $companiesArray['id']; 
		$companyname = $companiesArray['companyname'];
		
		
	
		
		
	
		
    //  if($x%2){
    
	if($currentcampaign == $id){
		
		$companies_table .='<tr class="even">';
		
			} else {
				
		$currentcampaign = 	$id;
		$companies_table .='<tr class="even" >';
					
		}
		
		$companies_table .="<td height='50' ><a href='$prefix/campaigns/index/editcompany/company/$id'>$companyname</a></td><td></td><td></td><td></td><td><a href='$prefix/campaigns/index/create/company/$id'>Create Campaign</a></td><td><a href='$prefix/campaigns/index/uploadimages/company/$id'>Upload Banners / Images</a></td><td><a href='$prefix/campaigns/index/getimagesbycompany/id/$id'>View Banners / Images</a><td><input type=checkbox  name=delete_$id ></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$companies_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="companies/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      }
      
      $companies_table .='</table>';
	 // $companies_table .="<input type='button' name='update' onclick='addShow()' value='Update Screens'>";
	  
      $companies_table .= '<input class="button" type="submit" name="Submit" id="Submit" value="Update companies">';
      
      $companies_table .='</form>';
		
		 return $companies_table;
      
      
      
    
    }
    
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
