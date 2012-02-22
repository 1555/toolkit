<?php 

$start = $_GET['start'];
$end = $_GET['end'];
$subject = $_GET['subject'];
$description = $_GET['description'];
$showid = $_GET['showid'];
$location = $_GET['location'];

 header("Content-Type: text/x-vCalendar");
 header("Content-Disposition: inline; filename=CNBC_Show_Alert.vcs"); 
 
//

?>
BEGIN:VCALENDAR
VERSION:1.0
BEGIN:VEVENT
SUMMARY:<?php echo $subject . "\n"; ?>
CLASS:PRIVATE
CATEGORIES:MEETING
LOCATION:<?php echo $location . "\n"; ?>
DESCRIPTION;ENCODING=QUOTED-PRINTABLE:<?php echo $description . "\n"; ?>
DTSTART:<?php echo $start . "\n"; ?>
DTEND:<?php echo $end. "\n"; ?>
END:VEVENT
END:VCALENDAR

<? 

registerAdded($showid);
 
function registerAdded($showid){
	
	if($_SERVER['HTTP_HOST'] == 'toolkit-stage.cnbceuropeshared.com'){
	$db = 'toolkit_stage';
$password= 'toolkit-stage';
$username = 'cnbctoolkit';
$host = '213.171.200.66';
}else{
	$db = 'toolkit';
$password= 'cnbcshared';
$username = 'cnbc';
$host = '213.171.200.47';
}


//var_dump($host);

	 
	include 'conn_pdo.inc.php';

$conn = dbConnect('query',$db, $password, $username,$host);
	 

		
		$sql = "SELECT addedtooutlook FROM alerts_interviews WHERE id = '$showid'";
		$result = $conn->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		$num = ($rows[0])+1; 
		$sql = "UPDATE alerts_interviews SET addedtooutlook = '$num' WHERE id = '$showid'";
		$result = $conn->query($sql);
		
		// to capture alert_id
		
		 
		 
		$sql = "SELECT alert_id FROM alerts_interviews WHERE id = '$showid'";
		$result = $conn->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		$id = $rows[0]; 
		
		
		
		
		
 
 		$sql = "SELECT interactions FROM alerts WHERE id = '$id'";
	 	$result = $conn->query($sql);
		$rows = $result->fetch();
		$result->closeCursor();
		
		$num = ($rows[0])+1; 
		
		$sql = "UPDATE alerts SET interactions = '$num'  WHERE id = '$id'";
		 $result = $conn->query($sql);
		
	  //  $result = $conn->query($sql);
	//	$result->closeCursor();
 }