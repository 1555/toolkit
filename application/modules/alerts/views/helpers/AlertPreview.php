<?php

class Zend_View_Helper_Alertpreview extends Zend_View_Helper_Abstract
{
    public function alertpreview(){
    	
    	 $prefix =  $this->view->baseUrl();

      //  $prefix =  $_SERVER['SCRIPT_NAME'];
    	$bannerA = $this->view->bannerA;
		$bannerB = $this->view->bannerB;
    	  $alert = $this->view->alert;
		  $subdom = $this->view->subdom;
    	 $shows = $this->view->shows;
		 if(isset($this->view->promo)){
		  $promo = $this->view->promo;
		 } else {
		  unset($promo);
			 
	 }
    	
    	  $pdate = $this->formatDateForPage($alert['date']);
    	  
 // var_dump($promo);
    	
    //testcall()	
	
	
	
	
    	  $alertpreview = "<html><head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>CNBC - GUEST ALERT EUROPE | MIDDLE EAST | AFRICA</title>
		<script type='text/javascript' src='$prefix/js/cnbc/alerts.js'></script>
		<script type='text/javascript' src='$prefix/js/cnbc/ajax-connection.js'></script>
		<script type='text/javascript' src='$prefix/js/cnbc/alerts_boot.js'></script>
	
	
	<!-- the style element is for links in outlook-->
	
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
<!-- table border style used for grey keyline -->
<table width='600'  cellpadding='0' cellspacing='0' id='main_container'   align='center' style='border-width:1px;border-style:solid;border-color:#CCCCCC;'><tr><td>

<table width='600'  cellpadding='0' cellspacing='0' align='center'><tr><td>


 <!-- Europe header banner -->
  <tr height='91'>
    <td id='banner'><a href='http://europe.cnbc.com'><img border='0' src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/header.jpg' width='600' height='91' alt='CNBC International' /></a></td>
  </tr>
  
  
  <!-- end Europe header banner -->
  
  <!-- main menu -->
  <tr valign='top'>
    <td id='menu'>
	<table border='0' id='menu_table' cellpadding='0' cellspacing='0'>
        <tr>
       
        <td><a href='http://www.cnbc.com/id/19794221/site/14081545/'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c1_s1.gif' border='0'/></a>
		</td>
		
        <td><a href='http://www.cnbc.com/id/15921552'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c2_s1.gif' border='0'/></a></td>
		
        <td><a href='http://www.cnbc.com/id/15839135'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c3_s1.gif' border='0'/></a></td>
		
        <td><a href='http://www.cnbc.com/id/15839069/site/14081545/?tabid=15839797&tabheader=false'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c4_s1.gif' border='0'/></a></td>
      
         <td><a href='http://www.cnbc.com/id/15839263/site/14081545/?tabid=15839797&tabheader=false'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c5_s1.gif' border='0'/></a></td>
		 
         <td><a href='http://www.cnbc.com/id/15838668/site/14081545/'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c6_s1.gif' border='0'/></a></td>
		 
         <td><a href='http://www.cnbc.com/id/30011296'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c7_s1.gif' border='0'/></a></td>
		  <td><a href='https://login.cnbc.com/cas/login?service=https://register.cnbc.com/j_acegi_cas_security_check&login-view=register?__source=CNBC|newsnow|pfheader|2009|'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/main_menu_r1_c8_s1.gif' border='0'/></a></td>

	</tr>
    </table>
	</td>
  </tr>
  <!-- end main menu -->
  
  <!-- banner a table -->
  <tr>
    <td id='banner_a'>
	<table width='600' border='0' cellpadding='0' cellspacing='0' id='banner_a_table'>
      <tr height='10'>
        <td width='66'></td>
        <td width='468'></td>
        <td width='66'></td>
      </tr>
      <tr>
	   <td width='70'></td>
	   <!---------- Top banner ---->
       <td id='banner_a_img' style='font-family:Arial;font-size:10px;color:#CCCCCC;'>ADVERTISMENT<div id='banner_a_image'>$bannerA</div></td>
       <td width='70'></td>
	  </tr>
      <tr>
       <td width='70'></td>
        <td width='468'></td>
        <td width='70'></td>
      </tr>
    </table>
	</td>
  </tr>
   <!-- end banner a table -->
  
  <!- guests table -->
  <tr>
    <td id='guests'>
	<table width='500' border='0'  cellpadding='10' cellspacing='0' id='guest_table' >
		<tr id='appearing'>
			<td style='font-family:Arial;font-size:20px;font-weight:bold;color:#005480;'>Guests Appearing on $pdate
			</td>
		</tr>
      <!-- g table goes here -->
	  <tr>
	  <td>
	  <table id='interviews_table' border='0'  cellpadding='0' cellspacing='0' width='580' align='center' >
	  
	  
	  
	  <!-- table head data -->
		  <tr>
			  <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c1_s1.gif' border='0'/></th>
			  <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c2_s1.gif' border='0'/></th>
			   <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c3_s1.gif' border='0'/></th>
			   <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c4_s1.gif' border='0'/></th>
			   <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c5_s1.gif' border='0'/></th>
			 <th width='100' align='left'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/guests_bar_r1_c6_s1.gif' border='0'/></th>
		  </tr>
	 <!-- end table head data -->"
		  ;
		  
	  $n = 0;
	  
	  foreach($shows as $s){
		  
		// var_dump($s);
		  
		  if($n%2){
		
		$col = 'background-color:#DDDDDD;';
		
	} else {
		$col = 'background-color:#FFFFFF;';
	}
		$n++;
		$time = $s['hrs'].':'.$s['mins'];
		$show = stripslashes($s['title']);
		$company = stripslashes($s['companyname']);
		$guesttitle = stripslashes($s['guesttitle']);
		$guestname = stripslashes($s['guestname']);
		$topic = stripslashes($s['topic']);
		$showid = $s['id'];
		$description= stripslashes($s['description']);
		$startForCal = $s['calstring'][0];
	    $endForCal = $s['calstring'][1];
		$subject = 'CNBC interview with '.$guestname.' ('.$company.')';
		$location = 'CNBC TV';
		
		  
		$alertpreview .="
		
		<!-- an individual interview -->
		<tr valign='top' style='font-family:Arial;font-weight:bold;color:#005480;font-size:12px;'>
			<td  width='70' align='left' style='$col;padding-top:5px;padding-bottom:10px;padding-right:5px;padding-left:10px;'>$time</td>
			<td  width='100' align='left' style='$col;padding-top:5px;padding-bottom:10px;padding-right:5px;'>$show</td>
			<td  width='100' align='left' style='$col;padding-top:5px;padding-right:5px;padding-bottom:10px;'>$guestname<br/><span style='font-weight:normal'>$guesttitle</span></td>
			<td  width='100' align='left' style='$col;padding-top:5px;padding-right:5px;padding-bottom:10px;'>$company</td>
			<td  width='100' align='left' style='$col;padding-top:5px;padding-right:5px;padding-bottom:10px;'>$topic</td>
			<td  width='70' align='right' style='$col;padding-top:5px;padding-right:5px;padding-bottom:10px;'><a href='http://".$subdom.".cnbceuropeshared.com/public/includes/alert.php?start=$startForCal&end=$endForCal&subject=$subject&location=$location&description=$topic&showid=$showid'><img src='http://".$subdom.".cnbceuropeshared.com/public/guest_alert/add_btn.jpg' border=0 width='41' height='19' alt='add' style='padding-top:10px;'></a></td>
		
		
		</tr>
		<!-- end of an interview -->
		
		
		
		";
		
		
		 
		  
	  }
	  
	  
       $alertpreview .= "
	   
	   </table>
	    <hr noshade='noshade' size='1' color='#CCCCCC'/> 
	   <!-- end interviews Table -->
	   </td>
	   
	 
	   
      </tr>
	 
  <!-- g table ends here -->
   <!-- begin A -->
  <!-- <tr><td cellspacing='0' cellpadding='0' > this thows out the guest table -->
  <table id='a' width='500'  height='610' align='center' style='text-align:left;' ><tr><td cellspacing='0' cellpadding='0' style='padding:0px;vertical-align:top;'>
  
 
     <!-- begin B-->
 <table id='b' cellspacing='0' cellpadding='0' width='410'>

  <!-- promos table -->
  <tr valign='top' height='140'>
    <td id='promos'>
		<table  width='400' border='0' cellspacing='0' cellpadding='0' style='margin:0px;padding-bottom:10px;'>
		
		<!-- end spacer row -->
					<tr>
					$promo
					</tr>
		</table>
	</td>
  </tr>
  <!-- end promos table -->
         
         <!-- news head -->
		 <tr id='news head' valign='top' height='190'>
		 
			 <td>
			 <table  width='300' cellpadding='0' cellspacing='0'><tr height='30'><td><span style='color:#666; font-family:Arial, Helvetica, sans-serif; font-size:16px;'>CNBC TOP NEWS AND VIDEOS</span></td></tr></table>
			
				<span id='top_stories_list' style='display:block;padding-top:0px;'></span>
			 </td>
		 </tr>
		 <!-- end news head -->
		 
		 <!-- blog head -->
		 
          <tr id='blog_head' valign='top' height='110' style='text-decoration:none;'>
			   <td>
			 <table width='300' cellpadding='0' cellspacing='0'><tr height='30'><td><span style='color:#666; font-family:Arial, Helvetica, sans-serif; font-size:16px;'>ON THE BLOGS</span></td></tr></table>
				<span id='blogs_list' style='display:block;padding-top:10px;'></span>
			   </td>
          </tr>
		  <!-- end blog head -->
		  
		  
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
	   
        <td  id='banner_b_img' width='160' height='600' style='font-family:Arial;font-size:10px;color:#CCCCCC;vertical-align:top;'><div id='banner_b_image'>$bannerB</div>ADVERTISMENT</td>
		
		</table>
        <!-- end A -->
 

  <table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#414042'> 
  
  
  
  <tr  height='24px'>
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
<td><tr></table>
</table>
<!--</div>-->



</body>
</html>";

return $alertpreview;


	}
	function formatDateForPage($d){
	
	date_default_timezone_set('GMT');
	
	$date = explode('-', $d);
	
	//var_dump($date) ;
	
	return date('l, j F  Y',mktime(0,0,0,$date[1],$date[2],(int)$date[0]));   //strtoupper(
	
	
}
}