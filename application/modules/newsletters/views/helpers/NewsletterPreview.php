
<?php

class Zend_View_Helper_Newsletterpreview extends Zend_View_Helper_Abstract
{
    public function newsletterpreview(){
    	
    	 $prefix =  $this->view->baseUrl();
	  //$prefix =  $_SERVER['SCRIPT_NAME'];
    	
		  $subdom = APPLICATION_SUBDOMAIN;
		
		$newsletter = $this->view->newsletter;
		$bannerB = $newsletter['banner_b'];
    	 date_default_timezone_set('UTC');
$body = stripslashes($newsletter[0]['newsletterBody']);
$banner_clickthrough = $newsletter['banner_clickthrough'];

$testdate = date('D');

if($testdate == 'Mon'){
	
	$date = date("d-m-y", strtotime("-3 day"));
	
}else{

    $date = date("d-m-y", strtotime("-1 day"));
		
}
			 
	//var_dump($newsletter);
    	
    	 // $pdate = $this->formatDateForPage($newsletter['date']);
    	  
 // var_dump($promo);
    	
    //testcall()	   
    	  $newletterpreview = "<html><head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<title>CNBC - MORNING BRIEF EUROPE | MIDDLE EAST | AFRICA</title>
		<script type='text/javascript' src='$prefix/js/cnbc/newsletters.js'></script>
		<script type='text/javascript' src='$prefix/js/cnbc/ajax-connection.js'></script>
		<script type='text/javascript' src='$prefix/js/cnbc/newsletters_boot.js'></script>
		
		
		<style media='all' type='text/css'>

a:link, a:visited {
     color:#64698c;
     text-decoration:none;
	 
	 }
	 


</style>
		
	</head>
	<!-- end head -->
	
	
	
	
<!-- body -->	
<body>

<!-- main alignment table -->

<table width='600'  cellpadding='0' cellspacing='0' id='main_container'   align='center' style='border-width:1px;border-style:solid;border-color:#CCCCCC;'><tr><td>
<table width='600'  cellpadding='0' cellspacing='0' align='center'><tr><td>



 <!-- Europe header banner -->
  <tr>
    <td id='banner' height='91'><a href='http://www.cnbc.com/id/41621340'><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/mornbrief_emea_header01.jpg' alt='CNBC International' border='0' height='91' width='600'></td>
  </tr>
  
  
  <!-- end Europe header banner -->
  
  <!-- main menu -->
  <tr>
    <td id='menu'>
	<table border='0' id='menu_table' cellpadding='0' cellspacing='0'>
    <tr>
       
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_premarkets.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_news.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_livedata.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_earnings.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_investing.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_video.gif' border='0' /></a></td>
        <td><a href='http://www.cnbc.com/id/17689937/site/14081545/' ><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/btn_cnbtv.gif' border='0' /></a></td>
      </tr>
   </table>
	</td>
  </tr>
  <!-- end main menu -->
  
  <!--- stocks block BB ---->
  <tr>
    <td id='guests'>
	<table id='guest_table' border='0' cellpadding='10' cellspacing='0' width='100%'>
		<tbody><tr id='appearing'>
			
		</tr>
	  <tr>
	 
	  <td style='margin-top:0px;padding-top:0px;' align='left'>
	   <span style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; color: rgb(0,84,128); font-size:9px;'>Market Close $date</span>
	  <hr noshade='noshade' size='1' color='#CCCCCC'/> 
	   </td>
	   
	 
	   
      </tr>
	 
  <!-- g table ends here -->
   <!-- begin A -->
   </table>
  <!-- stocks block BB ends -->
  
  <table id='a' style='text-align: left;' align='center' height='600' width='580'>
    <tr valign='top'><td style='padding: 0px; vertical-align: top;' cellspacing='0' cellpadding='0'>
  
 
     <!-- begin B-->
 <table id='b' style='margin: 0px;' cellpadding='0' cellspacing='0' height='600px' width='100%'>
 <!-- spacer row to push promo down now font-size is being used to style 'advertisment' above banner b  
		
		<tr>
		 
			<td>
				<img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/spacer.gif'  width='0px' height='0px'>
			</td>
		</tr>   -->
		<!-- end spacer row -->
  <!-- promos table -->
 <tr>
    <td id='promos' height='100px' align='left'>
		<table style='margin: 0px;' border='0' cellpadding='0' cellspacing='0' height='130px'>
		
		<!-- end spacer row -->
					<tr>
					
	<!-- left coll to push img to the right 
	<td width='2px'>
	<img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/spacer.gif' width='0px'>
	</td> -->
	
	<!-- promo img -->
	<!-- spacer coll to seperate promo img from headline -->
	<!-- contains headline and body text -->
	<td style='vertical-align: text-top;'>";
	
 $n = 0;
 
	 
	
	  foreach($newsletter['paragraphs'] as $p){
	
	
	
	
	$h2 = $this->view->escape(stripslashes($p['h2']));
	$para = $this->view->escape(stripslashes($p['p']));
	$link = $this->view->escape(stripslashes($p['link']));
	$link_text = $this->view->escape(stripslashes($p['link_text']));
	$trimed = trim($link);
	if(trim($link) == ''){
		$link_text = '';
		$link == '';
	}else{
		$link_text = 'Read More';
		$br = '<br/>';
		
	}
	
	$newletterpreview 	 .=" 
	<span style='font-size:12px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-bottom:-14px; color: rgb(0,84,128);'>$h2</span><br>
		<span style='font-size:12px;font-family:Arial, Helvetica, sans-serif; color: #000000;'>$para</span>
		  <a href='$link' style='font-size:12px;  font-family:Arial, Helvetica, sans-serif; margin-bottom:-14px; color: rgb(0,84,128);'><br>$link_text</a><br><br>";
		  
	  };
	
	$newletterpreview 	 .=" 

	</td>
    <!-- gutter column -->
	<td style='vertical-align: text-top;'><img src='http://".$subdom.".cnbceuropeshared.com/public/newsletter/spacer.gif' alt='' width='8px'></td>
    <!-- gutter column ends-->
					</tr>
		</table>
	</td>
  </tr>
  <!-- end promos table -->
         
         <!-- news head -->
		 <tr id='news head'>
		 
			 <td width='410' style='color:#666; font-family:Arial, Helvetica, sans-serif; font-size:16px;'>CNBC TOP NEWS AND ANALYSIS<br>
				<span id='top_stories_list' style='display: block; padding-bottom: 10px;'></span>
			 </td>
		 <!-- end news head -->
		 
		  
		  
         <!-- FB & Twitter-->
           <!-- FB & Twitter-->
          <tr id='twitter' valign='bottom' height='60'>
		  
           <table><tr><td width='30'>
				<!-- face book image -->
				<a href='http://www.facebook.com/cnbc' style='padding-left:0px;'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/facebook.gif' border='0' ></a></td>
				<!-- end face book img -->
					
				<!-- end face book link -->
			
				<!-- twitter image -->
				<td  width='40'>
				<a href='http://twitter.com/#!/CNBCWorld'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/twitter.gif' border='0' style='padding-left:5px;'></a></td>
				<!-- you tube logo -->
				<td>
				<a href='http://www.youtube.com/user/cnbc '><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/youtube.gif' border='0' style='padding-left:5px;'></a></td>
				
				<!-- end twiter img-->
				
				
			</tr></table>
       <!-- end B -->
	   
        </td><td width='160' height='600' id='banner_b_img' style='font-family:Arial;font-size:10px;color:#CCCCCC;vertical-align:top;'><div id='banner_b_image'><a href='http://www.ads-securities.com'><img src='$bannerB' style='border: medium none; vertical-align: top; float: left;' height='600' width='160'></a></div>ADVERTISMENT</td>
		
		</tr></tbody></table>
        <!-- end A -->
 
   <table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#414042'> 
  
  
  
  <tr height='24px'>
  <td><a href='http://www.cnbc.com/id/35083111'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/bottom_bar_r1_c1_s1.gif' border='0'/><a href='https://login.cnbc.com/cas/login?service=https://register.cnbc.com/j_acegi_cas_security_check&login_view=register
' style='text-decoration:none;color:#FFFFFF;'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/bottom_bar_r1_c2_s1.gif' border='0'/></a><a href='http://cnbc.sparklist.com/u?id=%%memberidchar%%&o=%%outmail.messageid%%&n=T&e=%%emailaddr%%&l=%%list.name%%' style='text-decoration:none; color:#FFFFFF;'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/bottom_bar_r1_c3_s1.gif' border='0'/></a><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/bottom_bar_r1_c4_s1.gif' border='0'/></td>
    
  </tr>
  <tr>
    <td height='70' id='footer'>
	<table  width='100%' border='0' cellspacing='0' cellpadding='5' style='font-family:Arial;color:#FFFFFF;font-size:9px;'>
      <tr>
        <td><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/logo.gif' width='215' height='39' alt='CNBC Logo' /></td>
      </tr>
      <tr height='15'>
        <td><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/spacer.gif' height='1' width='3'><img src='http://toolkit.cnbceuropeshared.com/public/newsletter/copyright.gif' width='7' height='7' alt='copyright' /> 2012 CNBC (UK) Limited. 10 Fleet Place London EC4M 7QS. All rights reserved</td>
      </tr>
    </table></td>
  </tr>
 <!-- end of the main wrapper table --> 
<td><tr></table></td>
  </tr>
</tbody></table>





</td></tr></tbody></table></div></body></html>";

return $newletterpreview ;


	}
	function formatDateForPage($d){
	
	date_default_timezone_set('GMT');
	
	$date = explode('-', $d);
	
	//var_dump($date) ;
	
	return date('l, j F  Y',mktime(0,0,0,$date[1],$date[2],(int)$date[0]));   //strtoupper(
	
	
}
}