<?php

header("content-type: text/javascript");
 
    if(isset($_GET['syms']) && isset($_GET['type']) && isset($_GET['callback'])) // makes sure 
    {
      
$syms =  $_GET["syms"];

$type = $_GET["type"];

$callback = $_GET["callback"];

if($type == 'stocks'){

$url = "http://quote.cnbc.com/quote-html-webservice/quote.htm?partnerId=partner8003&symbols=$syms&realtime=1&output=json&noform=1";

} elseif($type == 'stories') {
	
$url = "http://search.cnbc.com/main.do?output=json&tickersymbols=$syms&pagesize=5";
	
} elseif($type == 'videos') {
	
//$url = "http://plus.cnbc.com/rssvideosearch.do?output=json&airtime=24&airfreq=h&tickersymbols=$syms";

$url = "http://plus.cnbc.com/rssvideosearch.do?partnerId=7007&output=json&airtime=1&airfreq=w&tickersymbols=$syms";

	
}

$jsonresponse = file_get_contents($url);
//$arry = json_decode($jsonresponse);

//$obj->name = $_GET['name'];
     //   $obj->message = "Hello " . $obj->name;
 
        //echo $_GET['callback']. '(' . json_encode($obj) . ');';

echo $_GET['callback']. '(' . $jsonresponse . ');';
//echo  json_encode($arry);

	}

?> 