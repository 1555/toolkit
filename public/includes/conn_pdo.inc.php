<?php
function dbConnect($type,$db, $password, $username, $host) {
//	var_dump($host);
//	var_dump($username);
	//var_dump($password);
//	var_dump($db);
  if ($type  == 'query') {
    $user = $username;
	$pwd = $password;
	}
  elseif ($type == 'admin') {
   $user = $username;
	$pwd = $password;
	/*
	 $user = 'cnbc';
	$pwd = 'cnbcshared';
	
	*/
	}
  else {
    exit('Unrecognized connection type');
	}
  try {
  //  $conn = new PDO("mysql:host='$host';dbname='$db'; username='$user'; password='$pwd';");
	 $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    return $conn;
	}
  catch (PDOException $e) {
	 // var_dump($e);
   echo 'Cannot connect to database'; //'Cannot connect to database';
	exit;
	}
  }
?>