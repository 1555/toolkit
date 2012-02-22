<?php

$path = $_GET["url"];
$date = $_GET["date"];


//echo "path ".$path;

if($path == 'europe'){
	$xml=("http://search.cnbc.com/cmsSearch.do?ids=41638496&output=xml");
} else if($path == 'blogs'){
	$xml=("http://search.cnbc.com/cmsSearch.do?ids=21114821&output=xml");
} else if($path == 'shows'){
	//$xml=("http://geni.cnbc.com/EconCenter/GTData.asmx/getDailySchedule?dDate=".$date."&strBusinessname=CNBC:%20Europe");
$xml = ("http://geni.cnbc.com/EconCenter/GTData.asmx/getDailySchedule?dDate=$date&strBusinessname=CNBC:%20Europe");
} else if($path == 'stocks'){
	//$xml=("http://geni.cnbc.com/EconCenter/GTData.asmx/getDailySchedule?dDate=".$date."&strBusinessname=CNBC:%20Europe");
$xml = ("http://quote.cnbc.com/quote-html-webservice/quote.htm?symbols=.FTSE|.GDAXI|.FCHI|.SSMI&realtime=1&output=xml&noform=1");
} else if($path == 'europe-newsletter'){
	//$xml=("http://geni.cnbc.com/EconCenter/GTData.asmx/getDailySchedule?dDate=".$date."&strBusinessname=CNBC:%20Europe");
$xml=("http://search.cnbc.com/cmsSearch.do?ids=41638496&output=xml");
}

 // $xml=($path);
//  }

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
//$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
//$channel_title = $channel->getElementsByTagName('title')
//->item(0)->childNodes->item(0)->nodeValue;
//$channel_link = $channel->getElementsByTagName('link')
//->item(0)->childNodes->item(0)->nodeValue;
//channel_desc = $channel->getElementsByTagName('description')
//->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
//echo("<p><a href='" . $channel_link
  //. "'>" . $channel_title . "</a>");
//echo("<br />");
//echo($channel_desc . "</p>");

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('site-asset');

if($path == 'europe-newsletter'){
	
	$news = '';
	//$news .='<tr>';
	
	for ($i=0; $i<=9; $i++){
		//var_dump($x->item($i));
		if($x->item($i) !== NULL){
		$item_title=$x->item($i)->getElementsByTagName('title')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_link=$x->item($i)->getElementsByTagName('link')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_desc=$x->item($i)->getElementsByTagName('description')
		  ->item(0)->childNodes->item(0)->nodeValue;
		 // strip illeagals
		$item_desc = preg_replace('/[^(\x20-\x7F)]*/','', $item_desc);
		 $item_title = preg_replace('/[^(\x20-\x7F)]*/','', $item_title);
		
		 // $news .="<td><span style='display:block;height:10px;'><font face='Arial, Helvetica, sans-serif' color='rgb(0, 84, 128)' size='2'><p style='font-weight:bold;font-size:12px;height:5px;'><a href='" . $item_link. "' style='text-decoration:none;color:#005480'>" . $item_title . "</a></font></p></span></td>";
		 
	$news .= 	"<tr height='20px'><a href='".$item_link."' style='text-decoration: none; color: rgb(0, 84, 128); font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px;'><img src='http://toolkit-stage.cnbceuropeshared.com/public/newsletter/orange_arrow.gif' width='8' height='9' border='0'> ".$item_title."</a><tr><img src='http://toolkit.cnbceuropeshared.com/public/guest_alert/spacer.gif' width='0' height='20'></tr><br>";
	}
	
	
	
	}
	
	$news .= "</tr>";
	
	echo($news);

} elseif($path == 'europe'){
	
	$news = '';
	//$news .='<tr>';
	
	for ($i=0; $i<=9; $i++){
		//var_dump($x->item($i));
		if($x->item($i) !== NULL){
		$item_title=$x->item($i)->getElementsByTagName('title')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_link=$x->item($i)->getElementsByTagName('link')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_desc=$x->item($i)->getElementsByTagName('description')
		  ->item(0)->childNodes->item(0)->nodeValue;
		 // strip illeagals
		$item_desc = preg_replace('/[^(\x20-\x7F)]*/','', $item_desc);
		 $item_title = preg_replace('/[^(\x20-\x7F)]*/','', $item_title);
		
		 // $news .="<td><span style='display:block;height:10px;'><font face='Arial, Helvetica, sans-serif' color='rgb(0, 84, 128)' size='2'><p style='font-weight:bold;font-size:12px;height:5px;'><a href='" . $item_link. "' style='text-decoration:none;color:#005480'>" . $item_title . "</a></font></p></span></td>";
		 
	//	 $news .= "<font face='Arial, Helvetica, sans-serif' color='rgb(0, 84, 128)' size='2'><strong><a href='".$item_link. "' //style='text-decoration:none;color:#005480;height:0px;margin-bottom:3px;'>" . $item_title . "</a></strong></font><br/>";
	//if($i == 0){$rowheight = 20;} else {$rowheight = 20;};
$news .= 	"<tr><a href='".$item_link."' style='text-decoration: none; color: rgb(0, 84, 128); font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px;text-decoration:none;'><img src='http://toolkit.cnbceuropeshared.com/public/newsletter/orange_arrow.gif' width='8' height='9' border='0'> ".$item_title."</a><tr><img src='http://toolkit.cnbceuropeshared.com/public/guest_alert/spacer.gif' width='0' height='20'></tr><br/>";
	
	}
	
	
	
	}
	
	$news .= "</tr>";
	
	echo($news);

} else if($path == 'blogs'){
	
	$blogs = '';
	$blogs .= '<tr>';
		for ($i=0; $i<=1; $i++){
			if($x->item($i) !== NULL){
			$item_title=$x->item($i)->getElementsByTagName('title')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_link=$x->item($i)->getElementsByTagName('link')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_desc=$x->item($i)->getElementsByTagName('description')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  
		  
		  // strip illeagals
		  
		 $item_desc = preg_replace('/[^(\x20-\x7F)]*/','', $item_desc);
		 $item_title = preg_replace('/[^(\x20-\x7F)]*/','', $item_title);

		  
			// $blogs .="<td><span style='font-weight:bold;font-size:12px;height:3px;'><font face='Arial, Helvetica, sans-serif' color='rgb(0, 84, 128)' size='2'><a href='" . $item_link. "' style='text-decoration:none;color:#005480'>" . $item_title . "</a></font></span><br/><span style='display:block;font-weight:regular;font-size:11px;color:#000000;margin-bottom:0px;'><font face='Arial, Helvetica, sans-serif' color='rgb(102, 102, 102)' size='2'>".$item_desc."</font></span><br/></td></span>";
			
		//	$blogs .="<font face='Arial, Helvetica, sans-serif' color='rgb(0, 84, 128)' size='2'><a href='" . $item_link. "' style='text-decoration:none;color:#005480;height:15px;margin-bottom:5px;margin-top:5px;'><strong>" . $item_title . "</strong></a></font><br/><font face='Arial, Helvetica, sans-serif' color='rgb(102, 102, 102)' size='2' style='margin-bottom:7px;'>".$item_desc."</font><br/>";
			
		$blogs .="<span style='font-size:12px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-bottom:-14px; color: rgb(0,84,128);'><a href='$item_link' style='text-decoration:none;color: rgb(0, 84, 128); font-family:Arial, Helvetica, sans-serif;text-decoration:none;'>".$item_title."</a></span><br>
		<font color='#333' face='Arial, Helvetica, sans-serif' size='2'>".$item_desc.
		  $br."</font><br><br>";
		  
		  
	}
	$blogs .= '</tr>';
	}
	
	echo($blogs);
} else if($path == 'shows'){
	//$showsArray = array();
	$sarray = "";
	$num = $xmlDoc->getElementsByTagName('Table')->length;
	$x=$xmlDoc->getElementsByTagName('Table');
	$sarray .= '*';
	for ($i=0; $i<$num; $i++){
	
	$show_title=$x->item($i)->getElementsByTagName('SHOW_NAME')->item(0)->childNodes->item(0)->nodeValue;
	
	if($x->item($i)->getElementsByTagName('SHOW_NAME')->item(0)->childNodes != null){
		 //$xmlDoc;
	$show_title=$x->item($i)->getElementsByTagName('SHOW_NAME')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$show_title = '';
	}
	
	
	//$guest_lastname=$x->item($i)->getElementsByTagName('GUEST_LAST_NAME')->item(0)->childNodes->item(0)->nodeValue; //$xmlDoc;
	
	if($x->item($i)->getElementsByTagName('GUEST_LAST_NAME')->item(0)->childNodes != null){
		 //$xmlDoc;
	$guest_lastname=$x->item($i)->getElementsByTagName('GUEST_LAST_NAME')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$guest_lastname = '';
	}
	
	//$guest_firstname=$x->item($i)->getElementsByTagName('GUEST_FIRST_NAME')->item(0)->childNodes->item(0)->nodeValue; //$xmlDoc;
	
	if($x->item($i)->getElementsByTagName('GUEST_FIRST_NAME')->item(0)->childNodes != null){
		 //$xmlDoc;
	$guest_firstname=$x->item($i)->getElementsByTagName('GUEST_FIRST_NAME')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$guest_firstname = '';
	}
	
	//$guest_title=$x->item($i)->getElementsByTagName('GUEST_TITLE')->item(0)->childNodes->item(0)->nodeValue; //$xmlDoc;
	
	if($x->item($i)->getElementsByTagName('GUEST_TITLE')->item(0)->childNodes != null){
		 //$xmlDoc;
	$guest_title=$x->item($i)->getElementsByTagName('GUEST_TITLE')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$guest_title = '';
	}

	//$company_name=$x->item($i)->getElementsByTagName('COMPANY_NAME')->item(0)->childNodes->item(0)->nodeValue; //$xmlDoc;
	
	if($x->item($i)->getElementsByTagName('COMPANY_NAME')->item(0)->childNodes != null){
		 //$xmlDoc;
	$company_name=$x->item($i)->getElementsByTagName('COMPANY_NAME')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$company_name = '';
	}
	
	//$date=$x->item($i)->getElementsByTagName('APPEAR_DATE')->item(0)->childNodes->item(0)->nodeValue; //$xmlDoc
	if($x->item($i)->getElementsByTagName('APPEAR_DATE')->item(0)->childNodes != null){
		 //$xmlDoc;
	$date=$x->item($i)->getElementsByTagName('APPEAR_DATE')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$date = '';
	}
	if($x->item($i)->getElementsByTagName('TOPIC')->item(0)->childNodes != null){
		 //$xmlDoc;
	$topic=$x->item($i)->getElementsByTagName('TOPIC')->item(0)->childNodes->item(0)->nodeValue;
	} else {
	$topic = '';
	}
		 // $sarray = array('['.$show_title.','.$guest_lastname.','.$guest_firstname.','.$guest_title.','.$company_name.','.$date.','.$topic.']');
		   $sarray .= '~'.$show_title.'#'.$guest_lastname.'#'.$guest_firstname.'#'.$guest_title.'#'.$company_name.'#'.$date.'#'.$topic.'#@'; // use '~' so js can pull out
		 // array_push($showsArray,$sarray);
	}
	
	var_dump($sarray);
	
	
} else if($path == 'stocks'){
	$x=$xmlDoc->getElementsByTagName('QuickQuote');
	$stocks = "<td align='left' style='margin-bottom:0px;padding-bottom:0px;'>";
	
		for ($i=0; $i<=4; $i++){
			if($x->item($i) !== NULL){
	$last=$x->item($i)->getElementsByTagName('last')->item(0)->childNodes->item(0)->nodeValue;
	$change_pc=$x->item($i)->getElementsByTagName('change_pct')->item(0)->childNodes->item(0)->nodeValue;
	$symbol = $x->item($i)->getElementsByTagName('symbol')->item(0)->childNodes->item(0)->nodeValue;
	if($symbol == '.DJIA'){$symbol = 'DOW ';};
	if($symbol == '.FTSE'){$symbol = 'FTSE ';};
	if($symbol == '.GDAXI'){$symbol = 'DAX ';};
	if($symbol == '.FCHI'){$symbol = 'CAC ';};
	if($symbol == '.SSMI'){$symbol = 'SMI ';};
	
	if($change_pc < 0){
		
		$arrow = 'http://toolkit.cnbceuropeshared.com/public/newsletter/down_arrow.gif';
	}else if($change_pc > 0){
		$arrow = 'http://toolkit.cnbceuropeshared.com/public/newsletter/up_arrow.gif';
	}
	
$stocks .=	"<span style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; color: rgb(0,84,128); font-size:12px;'>".$symbol."<span style='color:#549A15;'>". $last ."<img src='".$arrow."' width='12' height='12'> </span>".$change_pc."%<img src='http://toolkit.cnbceuropeshared.com/public/guest_alert/spacer.gif' width='10'>";
	
	
			}
			
		}
	
	echo $stocks; //$stocks; //$stocks; //'hi there'; //$stocks;
}

//echo ("<br />");
//  echo ($item_desc . "</p>");
  
?> 