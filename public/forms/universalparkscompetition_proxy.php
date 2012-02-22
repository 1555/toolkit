<?php

//var_dump($_POST);

//if($_POST['submitted']==1){
	
	if($_POST['firstname'] && $_POST['surname'] && $_POST['emailaddress'] && $_POST['firstname'] && $_POST['streetaddress'] && $_POST['city'] && $_POST['postcode']){
		
		if($_POST['firstname'] !== '' && $_POST['surname'] !== '' && $_POST['emailaddress'] !== '' && $_POST['firstname'] !== '' && $_POST['streetaddress'] !== '' && $_POST['city'] !== '' && $_POST['postcode'] !== ''){


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

include '../includes/conn_pdo.inc.php';

$conn = dbConnect('query',$db, $password, $username,$host);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$firstname = sanityCheck('hele','string',50);
$firstname = sanityCheck(stripslashes($_POST['firstname']),'string',50);
$surname = sanityCheck(stripslashes($_POST['surname']),'string',50);
$emailaddress = checkEmail(sanityCheck(stripslashes($_POST['emailaddress']),'string',200));
$streetaddress = sanityCheck(stripslashes($_POST['streetaddress']),'string',100);
$city = sanityCheck(stripslashes($_POST['city']),'string',20);
$telephone = sanityCheck(stripslashes($_POST['telephone']),'number',20);
$postcode = IsPostcode(sanityCheck(stripslashes($_POST['postcode']),'string',8));

if($firstname !== FALSE && $surname !== FALSE && $emailaddress !== FALSE && $streetaddress !== FALSE && $city !== FALSE && $telephone !== FALSE && $postcode !== FALSE){



$stmt = $conn->prepare('INSERT INTO users (firstname, surname, emailaddress,streetaddress, city, telephone,postcode) VALUES(:firstname, :surname, :emailaddress, :streetaddress, :city, :telephone, :postcode)'); 

try{

$result = $stmt->execute( array('firstname' => $firstname, 'surname' => $surname, 'emailaddress' => $emailaddress, 'streetaddress'=> $streetaddress, 'city' => $city, 'telephone' => $telephone, 'postcode' => $postcode));

$conn = null;

} catch (PDOException $e){
	
	$message = $e->getCode();
	switch($message){
		case '23000':
		$text = 'You have used this email address already';
		break; 
		default:
			$text = 'We have experinced an error. Please try again';
			break;
	}
	
	
}

if($result == true){
	emailAdmin($firstname, $surname);
	emailUser($firstname, $surname);
	echo "thank you for entering our competition";
	
}else {
	echo $text;
}
	
	;

		} else {
			echo 'There is some data missing from you submission';
			
		};

	}else {
		echo 'There is some data missing from you submission';
	};

function emailAdmin($firstname,$surname){
	
    	//$to = "karolina.nilsson@cnbc.com";
		$to = "edwardhunton@gmail.com";
    	//$to = $admin['email'];
    	$from = "edward.hunton@cnbc.com";
    	$subject = "Universal Parks Competition Entry";
    	$body = $firstname.' '.$surname.' Has entered the competition';
    	$headers =  'from: edward.hunton@cnbc.com';
    	mail($to, $subject, $body, $headers);
	
};

function emailUser($firstname,$surname){
	
    	//$to = "karolina.nilsson@cnbc.com";
		$to = "edwardhunton@gmail.com";
    	//$to = $admin['email'];
    	$from = "edward.hunton@cnbc.com";
    	$subject = "Universal Parks Competition Entry";
    	$body = 'Thanks for entering our competition '.$firstname.' '.$surname.' . The closing date is the 10:03:12';
    	$headers =  'from: edward.hunton@cnbc.com';
    	mail($to, $subject, $body, $headers);
	
};


    function IsPostcode($postcode)
    {
    $postcode = strtoupper(str_replace(' ','',$postcode));
    if(preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/",$postcode) || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/",$postcode) || preg_match("/^GIR0[A-Z]{2}$/",$postcode))
    return true;
    else
    return FALSE;
    };
	
	function checkEmail( $email ){
    return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}

	} else {
		
		echo "There was an error submiting you form";
		
	};
	
	function sanityCheck($string, $type, $length){

  // assign the type
  $type = 'is_'.$type;

  if(!$type($string))
    {
    return FALSE;
    }
  // now we see if there is anything in the string
  elseif(empty($string))
    {
    return FALSE;
    }
  // then we check how long the string is
  elseif(strlen($string) > $length)
    {
    return FALSE;
    }
  else
    {
    // if all is well, we return TRUE
    return $string; /***************** my idea **/
	//return TRUE;
    }
};





?>
