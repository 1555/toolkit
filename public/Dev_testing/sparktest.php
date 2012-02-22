<?php

$wsdl_location = 'http://cnbc.sparklist.com:82/?wsdl';

$userName = 'edward.hunton@cnbc.com';

$password = 'Pa55word';

 

// Pull in the NuSOAP code

if ( PHP_VERSION >= 5 )

     require_once('../sparklist_php/php/lib/nusoap_php5.php');

else

     require_once('../sparklist_php/php/lib/nusoap_php4.php');

 

// create client

if ( PHP_VERSION >= 5 )

     $lmapiClient = new nusoapclient( $wsdl_location, true );

else

     $lmapiClient = new soapclient( $wsdl_location, true );

 

//set basic authentication

$lmapiClient->setCredentials($userName,$password, 'basic');

 

//make sure there was no error.

$err= $lmapiClient->getError();

//var_dump($lmapiClient);

if ($err) {

     echo "<h2>Error</h2><pre> $err <hr> $lmapiClient->debug_str;\n\n";

     return false;

     }

 

$lmapi = $lmapiClient->getProxy();

 

//set basic authentication

$lmapi->setCredentials($userName,$password, 'basic');

$api_version = $lmapi->ApiVersion();
 

echo "<h3> Current version of API at " . $wsdl_location . " is: " . $api_version . "</h3>\n";

 

?>