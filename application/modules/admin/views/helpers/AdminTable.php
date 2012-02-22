<?php
class Zend_View_Helper_Admintable extends Zend_View_Helper_Abstract
{
    public function admintable(){
      $admins = $this->view->content;
      $adminsArray = $this->object_to_array($admins);
      //$prefix =  $this->baseUrl();

      $prefix =  $_SERVER['SCRIPT_NAME'];
      $admins_table = "<form id='form1' name='form1' method='post' action='$prefix/admin/index/managemultiple'>";
      $admins_table .='<table id="table" width=100%>';
      $admins_table .="<tr><th>Name <a href='$prefix/admin/index/filterby/filter/lastname/dir/ASC'>Asc </a><a href='$prefix/admin/index/filterby/filter/lastname/dir/DESC'>Desc</a></th><th>Email</th><th>Role <a href='$prefix/admin/index/filterby/filter/role/dir/ASC'>Asc </a><a href='$prefix/admin/index/filterby/filter/role/dir/DESC'>Desc</a></th><th>Edit</th><th>Re-advise username</th><th>Re-advise password</th><th>Re-advise username & password</th><th>Remove user</th></tr>"; 
      $x = 1;
      foreach($adminsArray as $n){
      	
      	//var_dump($n);
      	$adminsArray = array();
		$adminsArray = $this->object_to_array($n);
		$id = $n['id']; 
		$username = $n['username']; 
		$password = $n['password']; 
		$role = $n['role'];
		
		$lastname = $n['lastname'];
		$firstname = $n['firstname'];
		$email = $n['email'];
		//$title = $adminsArray['pollname'];
		//$description = $adminsArray['polldescription'];
		//$question = $adminsArray['pollquestion'];
		//$createddate = $adminsArray['datecreated'];
		//$Dolby = $adminsArray['sr_dolby'];
		//$Wheelchair = $adminsArray['sr_whlchr_qty'];
//		
//var_dump($adminsArray);
      if($x%2){
			
$admins_table .='<tr class="even">';	
		
			} else {
			
$admins_table .='<tr class="odd">';
					
			}
		$admins_table .="<td>$lastname $firstname</td><td>$email</td><td>$role</td><td><a href='$prefix/admin/index/edit/id/$id'>Edit User</a></td><td><a href='$prefix/admin/index/adviseusername/id/$id'>Readvise Username</a></td><td><a href='/tool/public/admin/index/advisepassword/id/$id'>Readvise Password</a></td><td><a href='/tool/public/admin/index/adviseusernamepassword/id/$id'>Readvise Username & Password</a></td></a></td><td><input type=checkbox  name=delete_$id ></td>";	
			//<input type='button' name='update' onclick='viewPreview();' value='Update Screens'>
	//$admins_table .='<td>'. $id .'</td><td>'. $title .'</td><td>'. $description .'</td><td>'. $question .'</td><td>'. $createddate .'</td><td></td><td></td>
			//<td><a href="admins/index/edit/id/'.$id.'">edit</a></td><td><a href="/screenings/index/id/'.$id.'">Screenings</a></td></tr>';
			
		//$x++;
		
      	
      };
      
      $admins_table .='</table>';
  $admins_table .="<input type='submit' name='update' value='Update Users'>";
	  $admins_table .='</form>';
		
		 return $admins_table;
      
      
      
    
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
