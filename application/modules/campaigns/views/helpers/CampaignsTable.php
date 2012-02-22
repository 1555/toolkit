<?php
class Zend_View_Helper_Campaignstable extends Zend_View_Helper_Abstract
{
    public function campaignstable(){
		
      //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
	  $campaigns = $this->view->content;
      $clickthroughs = $this->view->content;
      $campaignsArray = $this->object_to_array($campaigns);
      
      $campaigns_table = "<form id='form1' name='form1' method='post' action='$prefix/campaigns/index/managemultiple'>";
      $campaigns_table .='<table id="table">';
      $campaigns_table .="<tr><th><a href='$prefix/campaigns/index/filterby/filter/title'>Campaign Title<a></th><th><a href='$prefix/campaigns/index/filterby/filter/company'>Company</a></th><th><a href=''>Start Date</a></th><th><a href=''>End Date</a></th><th>Length (Days)</th><th>Days Left to run</th><th>Click-throughs</th><th>Alert Banner</th><th>Alert Skyscraper</th><th><a href=''>Created By</a></th><th>4 Alert</th><th>4 News Letter</th><th>Remove Campaign</th></tr>"; 
      $x = 1;
      foreach($campaignsArray as $n){
      	
 // var_dump($n);
     	
      	$campaignsArray = array();
		$campaignsArray = $this->object_to_array($n);
		$id = $campaignsArray['id']; 
		//$image_name = $campaignsArray['image_name'];
		$title = $campaignsArray['title'];
		$company = $campaignsArray['companyname'];
		$comid = $campaignsArray['comid'];
		$startdate = $campaignsArray['startdate'];
		$clickthroughurl = $campaignsArray['clickthroughurl'];
		$clickthroughurl_B = $campaignsArray['clickthroughurl_B'];
		$enddate = $campaignsArray['enddate'];
		$modifiedbyid = $campaignsArray['modifiedbyid'];
		$count = $campaignsArray[0]['COUNT(*)'];
		$name = $campaignsArray[1]['firstname'].' '.$campaignsArray[1]['lastname'];
		$email = $campaignsArray[1]['email'];
		$useforalert = $campaignsArray['useforalerts'];
		$usefornewsletter = $campaignsArray['usefornewsletter'];
		if($useforalert =='1'){
			$useforalert = 'Yes';
		} else {
			$useforalert = 'No';
		}
		
		if($usefornewsletter =='1'){
			$usefornewsletter = 'Yes';
		} else {
			$usefornewsletter = 'No';
		}
		//$campMod = new Campaigns_Model_DbTable_Campaigns();
     	//$clickthroughs = $campMod->getClickThroughsByCampaignById($id);
     	$dateDiff =	$this->dateDiff('-', $startdate, $enddate);
     	$d = date('Y-m-d');
     	$hasBegun = $this->dateDiff('-', $startdate, $d);
     //	var_dump($hasBegun);
     	if($hasBegun > 0){
     		$daysLeft =	$this->dateDiff('-', $d, $enddate);
     	} else {
     		$daysLeft = 'Not started';
     	}
     	
     //	var_dump($dateDiff);
//		
//var_dump($campaignsArray);
      if($x%2){
			
$campaigns_table .='<tr class="even">';	
		
			} else {
			
$campaigns_table .='<tr class="odd">';
					
			}
$campaigns_table .="<td><a href='$prefix/campaigns/index/edit/id/$id'>$title</a></td><td>$company</td><td>$startdate</td><td>$enddate</td><td>$dateDiff</td><td>$daysLeft</td><td>$count</td><td><a href='$clickthroughurl'><img src='$prefix/assets/$comid/campaigns/$id/images/banner/banner.gif' width='80'></a></td><td><a href='$clickthroughurl_B'><img src='$prefix/assets/$comid/campaigns/$id/images/banner/skyscraper.gif' width='80'></a></td><td><a href='mailto:$email'>$name</a></td><td>$useforalert</td><td>$usefornewsletter</td><td><input type=checkbox  name=delete_$id ></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$campaigns_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="campaigns/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $campaigns_table .='</table>';
	  $campaigns_table .= '<input class="button" type="submit" name="Submit" id="Submit" value="Update Campaigns">';
	  $campaigns_table .='</form>';
		
		 return $campaigns_table;
      
      
      
    
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
		
function dateDiff($dformat, $endDate, $beginDate)
		{
		$date_parts1 = array();	
		$date_parts2 = array();	
		$date_parts1=explode($dformat, $beginDate);
		$date_parts2=explode($dformat, $endDate);
		//var_dump($date_parts1[1]);
		$s_date = gregoriantojd((int)$date_parts1[1], (int)$date_parts1[2], (int)$date_parts1[0]);
		$end_date=gregoriantojd((int)$date_parts2[1], (int)$date_parts2[2], (int)$date_parts2[0]);
		//var_dump($s_date);
		//var_dump($end_date);
		$diff = $s_date - $end_date; 
		//var_dump($diff);
		return $diff;
		}

}
