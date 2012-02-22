<?php


$id = $_GET['campaigncode'];
$position= $_GET['position'];

//var_dump($_SERVER['HTTP_HOST']);

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

include 'includes/conn_pdo.inc.php';

$conn = dbConnect('query',$db, $password, $username,$host);

$sql = "INSERT campaigns_clickthroughs (campaigncode) VALUES ('$id')";


$result = $conn->query($sql);
$sql = "SELECT clickthroughurl, clickthroughurl_B FROM campaigns WHERE id = '$id'";

$result = $conn->query($sql);
$rows = $result->fetch();
$result->closeCursor();
		//return $rows;
//var_dump($rows['clickthroughurl']);

if($position == 'banner'){

header('Location:'. $rows['clickthroughurl']);

}else {
	header('Location:'. $rows['clickthroughurl_B']);
}


