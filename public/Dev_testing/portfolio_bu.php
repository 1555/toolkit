<?php

header("content-type: text/javascript");
 
    if(isset($_GET['syms']) && isset($_GET['type']) && isset($_GET['callback'])) // makes sure 
    {
      
$syms =  $_GET["syms"];

$type = $_GET["type"];

$callback = $_GET["callback"];

//var_dump($syms);

if($type == 'stocks'){

$url = "http://quote.cnbc.com/quote-html-webservice/quote.htm?partnerId=partner8003&symbols=$syms&realtime=1&output=json&noform=1";
$jsonresponse = file_get_contents($url);
$stocksarry = json_decode($jsonresponse);

//$obj->name = 'stocks';
//$obj->message = "Hello " . $obj->name;

//echo $callback. '(' . json_encode($obj) . ');';

//if(isset($_GET['name']) && isset($_GET['callback']))
  //  {
      //  $obj->name = 'hi'; //$_GET['name'];
    //    $obj->message = "Hello " . $obj->name;
 
        echo $_GET['callback']. '(' . json_encode($stocksarry) . ');';
  //  }

//}

	}
	}

/*

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$sarray = "";
	$num = $xmlDoc->getElementsByTagName('QuickQuote')->length;
	$x=$xmlDoc->getElementsByTagName('QuickQuote');
	
	for ($i=0; $i<$num; $i++){


$item = '*';
$item .= $x->item($i)->getElementsByTagName('last')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('name')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('symbol')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('change')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('change_pct')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('realTime')->item(0)->childNodes->item(0)->nodeValue;
//$item .= '@';

$sarray .= $item;



	}
	
}elseif($type == 'stories') {
	
	$xml = ("http://search.cnbc.com/main.do?output=xml&tickersymbols=$syms&pagesize=5");

//$storiesxml = ("http://search.cnbc.com/main.do?output=xml&tickersymbols=$storysyms"); //mcd;goog;ba;s

//$xml = ("http://geni.cnbc.com/EconCenter/GTData.asmx/getDailySchedule?dDate=$date&strBusinessname=CNBC:%20Europe");

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$sarray = "";
	$num = $xmlDoc->getElementsByTagName('site-asset')->length;
	$x=$xmlDoc->getElementsByTagName('site-asset');
	
	for ($i=0; $i<$num; $i++){


$timesince = $x->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;
$time = humanTiming($timesince);

$item = '*';
$item .= $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $time;

//$item .= '@';

$sarray .= $item;

	}
	
} elseif($type='videos'){
	
	//$xml = ("http://plus.cnbc.com/rssvideosearch.do?partnerId=8003&output=xml&tickersymbols=$syms");
	$xml = ("http://plus.cnbc.com/rssvideosearch.do?output=rss&airtime=24&airfreq=h&tickersymbols=$syms");
	
	$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$sarray = "";
	$num = $xmlDoc->getElementsByTagName('item')->length;
	$x=$xmlDoc->getElementsByTagName('item');
	
	for ($i=0; $i<$num; $i++){
	$md = $x->item($i)->getElementsByTagName('pubDate');	
$timesince = $md->item(1)->childNodes->item(0)->nodeValue;
$time = humanTiming($timesince);

$item = '*';
$item .= $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
$item .= '#';
$item .= $time;



// $metadata = $x.getElementsByTagNameNS('pubDate');
//$item .= '@';

$sarray .= $item;

	}

	
}

//echo 'bork({"Image": { "Width":500, "Height":250, "Title":"Giant Cow", "Thumbnail":{"Url":"http://someurl.com/image/1234", "Height": 75, "Width": 150}}});';	
//foreach ($md as $node) {
//    var_dump($md->item(1)->childNodes->item(0)->nodeValue);
//}


//$time = strtotime('2010-04-28 17:25:43');

//echo humanTiming($time);

function humanTiming ($time)
{

  //  return $time;
	//return round($time, 10);
	$time = time() - substr($time, 0,10); // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
		
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}


//echo $xmlDoc->saveXML($md->item(3)); //var_dump($md->item(0)->getElementsByTagName('pubDate'));
 */  
?> 