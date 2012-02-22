<?php

class Zend_View_Helper_Campaignspreview extends Zend_View_Helper_Abstract
{
    public function campaignspreview(){
    	
    	 
    	
    	  $alert = $this->view->alert;
    	  $shows = $this->view->shows;
    	  
    	  $pdate = $this->formatDateForPage($alert['date']);
    	  
    	  //var_dump($alert);
    	  
    	  $alertpreview = "<style>
				<!--
				 /* Font Definitions */
				 @font-face
					{font-family:Tahoma;
					panose-1:2 11 6 4 3 5 4 4 2 4;}
				@font-face
					{font-family:Verdana;
					panose-1:2 11 6 4 3 5 4 4 2 4;}
				 /* Style Definitions */
				 p.MsoNormal, li.MsoNormal, div.MsoNormal
					{margin:0cm;
					margin-bottom:.0001pt;
					font-size:12.0pt;
					font-family:'Times New Roman';}
				a:link, span.MsoHyperlink
					{color:blue;
					text-decoration:underline;}
				a:visited, span.MsoHyperlinkFollowed
					{color:blue;
					text-decoration:underline;}
				p.style5, li.style5, div.style5
					{margin-right:0cm;
					margin-left:0cm;
					font-size:12.0pt;
					font-family:'Times New Roman';
					color:navy;}
				span.EmailStyle20
					{font-family:Arial;
					color:black;
					font-weight:normal;
					font-style:normal;
					text-decoration:none none;}
				@page Section1
					{size:595.3pt 841.9pt;
					margin:72.0pt 90.0pt 72.0pt 90.0pt;}
				div.Section1
					{page:Section1;}
				-->
				</style>

				</head>

<body bgcolor=white lang=EN-GB link=blue vlink=blue leftmargin=0 topmargin=0
marginwidth=0 marginheight=0>



<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=585
 style='width:438.75pt'>
 <tr>
  <td colspan=4 valign=top style='padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'><img width=595 height=140
  src='http://reports.cnbceuropeshared.com/guestalert/images/header01.gif'></span></font></p>
  </td>
 </tr>
 <tr height=10 style='height:7.5pt'>
  <td height=10 valign=top style='padding:0cm 0cm 0cm 0cm;height:7.5pt'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td height=10 valign=top style='padding:0cm 0cm 0cm 0cm;height:7.5pt'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td height=10 valign=top style='padding:0cm 0cm 0cm 0cm;height:7.5pt'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td height=10 valign=top style='padding:0cm 0cm 0cm 0cm;height:7.5pt'>
  <p class=MsoNormal style='margin-bottom:12.0pt'><font size=3
  face='Times New Roman'><span style='font-size:12.0pt'><br>
  </span></font><b><font color='#00457a' face=Arial><span style='font-family:
  Arial;color:#00457A;font-weight:bold'>Guests appearing on CNBC (Europe, Middle East, Africa)";

    	  
    	 if(isset($pdate)){
    	$alertpreview .=" $pdate";
    	 };
    	 
    	 
    	$alertpreview .= "</span></font></b></p>
  </td>
 </tr>
 <tr>
  <td width=10 valign=top style='width:7.5pt;padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td width=100 valign=top style='width:75.0pt;padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=1 color='#00457a' face=Arial><span
  style='font-size:7.5pt;font-family:Arial;color:#00457A'><img width=8
  height=8 src='http://guestalert.cnbceuropeshared.com/images/blue_arrow01.gif'><b><span
  style='font-weight:bold'><a href='http://europe.cnbc.com'>CNBC News </a><br>
  </span></b><img border=0 width=8 height=8
  src='http://guestalert.cnbceuropeshared.com/images/blue_arrow01.gif'><a
  href='http://europetv.cnbc.com'>CNBC TV </a><br>
  <img border=0 width=8 height=8
  src='http://guestalert.cnbceuropeshared.com/images/blue_arrow01.gif'><b><span
  style='font-weight:bold'><a href='http://www.cnbc.com/id/15895200'>Receiving
  CNBC</a></span></b><br>
  <img border=0 width=8 height=8
  src='http://guestalert.cnbceuropeshared.com/images/blue_arrow01.gif'><b><span
  style='font-weight:bold'><a href='http://www.cnbc.com/id/16673162'>Contact</a></span></b></span></font></p>
  </td>
  <td width=10 valign=top style='width:7.5pt;padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td width=475 valign=top style='width:356.25pt;padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><!-- EDIT LEAD PARAGRAPH HERE --><!-- END EDIT HERE --><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=475
   style='width:356.25pt' height=80>
   <tr height=20 style='height:15.0pt'>
    <td height=20 valign=top style='padding:0cm 0cm 0cm 0cm;height:15.0pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'><img border=0 width=66 height=1
    src='http://reports.cnbceuropeshared.com/guestalert/images/blue_dot01.gif'><br>
    </span></font><font size=1 color='#94acc8' face=Verdana><span
    style='font-size:7.5pt;font-family:Verdana;color:#94ACC8'>ADVERTISMENT</span></font></p>
    </td>
   </tr>
   <tr height=60 style='height:45.0pt'>
    <td height=60 valign=top style='padding:0cm 0cm 0cm 0cm;height:45.0pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'><a href='http://www.cnbc.com/id/33077961'
    target='_blank'><span style='text-decoration:none'><img border=0 width=468
    height=60
    src='../addSpace/bannerA.jpg'></span></a><br> <!--../addSpace/bannerA.jpg -->
    <br>
    <img border=0 width=66 height=1
    src='http://reports.cnbceuropeshared.com/guestalert/images/blue_dot01.gif'></span></font></p>
    </td>
   </tr>
  </table>
  <p class=MsoNormal></p>
  </td>
 </tr>
 <tr>
  <td valign=top style='padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td valign=top style='padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal style='margin-bottom:12.0pt'><font size=3
  face='Times New Roman'><span style='font-size:12.0pt'><br>
  <br>
  <br>
  </span></font></p>
  </td>
  <td valign=top style='padding:0cm 0cm 0cm 0cm'>
  <p class=MsoNormal><font size=3 face='Times New Roman'><span
  style='font-size:12.0pt'>&nbsp;</span></font></p>
  </td>
  <td valign=top style='padding:0cm 0cm 0cm 0cm'>
  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=475
   style='width:356.25pt'>
   <tr>
    <td width=10 bgcolor='#00457A' style='width:7.2pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 color='#fe9c03' face='Times New Roman'><span
    style='font-size:12.0pt;color:#FE9C03'>&nbsp;</span></font></p>
    </td>
    <td width=60 bgcolor='#00457A' style='width:45.0pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=1 color='#fe9c03' face=Arial><span
    style='font-size:7.5pt;font-family:Arial;color:#FE9C03'>TIME (CET) </span></font></p>
    </td>
    <td width=10 bgcolor='#00457A' style='width:7.2pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 color='#fe9c03' face='Times New Roman'><span
    style='font-size:12.0pt;color:#FE9C03'><img border=0 width=1 height=20
    src='http://reports.cnbceuropeshared.com/guestalert/images/white_dot01.gif'></span></font></p>
    </td>
    <td width=105 bgcolor='#00457A' style='width:78.75pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=1 color='#fe9c03' face=Arial><span
    style='font-size:7.5pt;font-family:Arial;color:#FE9C03'>SHOW</span></font></p>
    </td>
    <td width=10 bgcolor='#00457A' style='width:7.2pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 color='#fe9c03' face='Times New Roman'><span
    style='font-size:12.0pt;color:#FE9C03'><img border=0 width=1 height=20
    src='http://reports.cnbceuropeshared.com/guestalert/images/white_dot01.gif'></span></font></p>
    </td>
    <td width=145 bgcolor='#00457A' style='width:108.75pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=1 color='#fe9c03' face=Arial><span
    style='font-size:7.5pt;font-family:Arial;color:#FE9C03'>NAME &amp; TITLE </span></font></p>
    </td>
    <td width=10 bgcolor='#00457A' style='width:7.2pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 color='#fe9c03' face='Times New Roman'><span
    style='font-size:12.0pt;color:#FE9C03'><img border=0 width=1 height=20
    src='http://reports.cnbceuropeshared.com/guestalert/images/white_dot01.gif'></span></font></p>
    </td>
    <td width=145 bgcolor='#00457A' style='width:108.75pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=1 color='#fe9c03' face=Arial><span
    style='font-size:7.5pt;font-family:Arial;color:#FE9C03'>COMPANY &amp; TOPIC
    </span></font></p>
    </td>
    <td width=145 bgcolor='#00457A' style='width:108.75pt;background:#00457A;
    padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=1 color='#fe9c03' face=Arial><span
    style='font-size:7.5pt;font-family:Arial;color:#FE9C03'>ALERT
    </span></font></p>
    </td>
   </tr><tr>";
   
    foreach($shows as $s){
   	//var_dump($s);
    	$guestname = $s['guestname'];
    	$guesttitle = $s['guesttitle'];
    	$companyname = $s['companyname'];
    	$showname = $s['title'];
    	$topic = $s['topic'];
    	$alertstart = $s['starttime'];
    	//$alertend = $s['endtime'];
    	$startForCal = $s['calstring'][0];
    	$endForCal = $s['calstring'][1];
    	$description = $s['description'];
    	$subject = $showname.' Guest Alert Reminder';
    	
		$alertpreview .= "<td></td><td>$alertstart</td><td></td><td>$showname</td><td></td><td>$guestname<br/>$guesttitle</td></td><td><td>$companyname<br/>$topic</td><td><a href='http://guestalertdev.cnbceuropeshared.com/includes/test.php?start=$startForCal&end=$endForCal&subject=$subject&description=$description'>Add Alert</a></td></tr>";
	}
   
   "<tr height=3 style='height:2.25pt'>
    <td height=3 valign=top bgcolor='#E5ECF1' style='background:#E5ECF1;
    padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top bgcolor='#E5ECF1' style='background:#E5ECF1;
    padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top style='padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td width=105 height=3 valign=top style='width:78.75pt;padding:0cm 0cm 0cm 0cm;
    height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top bgcolor='#E5ECF1' style='background:#E5ECF1;
    padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top bgcolor='#E5ECF1' style='background:#E5ECF1;
    padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top style='padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td height=3 valign=top style='padding:0cm 0cm 0cm 0cm;height:2.25pt'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
   </tr>
   <tr>
    <td width=10 valign=top bgcolor='#E5ECF1' style='width:7.2pt;background:
    #E5ECF1;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    	
    	
    

		
   	
  
    
    <td width=60 valign=top bgcolor='#E5ECF1' style='width:45.0pt;background:
    #E5ECF1;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><b><font size=2 color='#00457a' face=Arial><span
    style='font-size:10.0pt;font-family:Arial;color:#00457A;font-weight:bold'></span></font></b></p>
    </td>
    <td width=10 valign=top style='width:7.2pt;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td width=105 valign=top style='width:78.75pt;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><b><font size=2 color='#00457a' face=Arial><span
    style='font-size:10.0pt;font-family:Arial;color:#00457A;font-weight:bold'></span></font></b></p>
    </td>
    <td width=10 valign=top bgcolor='#E5ECF1' style='width:7.2pt;background:
    #E5ECF1;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td width=145 valign=top bgcolor='#E5ECF1' style='width:108.75pt;
    background:#E5ECF1;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><strong><b><font size=2 color='#00457a' face=Arial><span
    style='font-size:10.0pt;font-family:Arial;color:#00457A'></span></font></b></strong><font
    size=2 color='#00457a' face=Arial><span style='font-size:10.0pt;font-family:
    Arial;color:#00457A'><br>
  </span></font></p>
    </td>
    <td width=10 valign=top style='width:7.2pt;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal><font size=3 face='Times New Roman'><span
    style='font-size:12.0pt'>&nbsp;</span></font></p>
    </td>
    <td width=145 valign=top style='width:108.75pt;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal style='margin-bottom:12.0pt'><strong><b><font size=2
    color='#00457a' face=Arial><span style='font-size:10.0pt;font-family:Arial;
    color:#00457A'></span></font></b></strong><font size=2 color='#00457a'
    face=Arial><span style='font-size:10.0pt;font-family:Arial;color:#00457A'><br></span></font></p>
    </td>
    <td width=145 valign=top style='width:108.75pt;padding:0cm 0cm 0cm 0cm'>
    <p class=MsoNormal style='margin-bottom:12.0pt'><strong><b><font size=2
    color='#00457a' face=Arial><span style='font-size:10.0pt;font-family:Arial;
    color:#00457A'></span></font></b></strong><font size=2 color='#00457a'
    face=Arial><span style='font-size:10.0pt;font-family:Arial;color:#00457A'><br></span></font></p>
    </td>
   </tr>
   
 
   <tr><td>
   <ul style='margin-left:0px; padding-left:0px; font-family:Arial, Helvetica, sans-serif; color:#333333;  font-size:12px; list-style:none; padding-top:10px;'>
              <li style='padding-bottom:5px;'><a href='http://www.facebook.com/cnbc' style='text-decoration:none; color:#3399FF;'><img src='http://media.cnbc.com/i/CNBC/Components/Email/shareSocialNetworks/faceBookIcon.jpg' width='16' height='16' border='0' />&nbsp;Fan us on Facebook</a></li>
              <li style='padding-bottom:5px;'><a href='http://twitter.com/CNBCEuropeBreak' style='text-decoration:none; color:#3399FF;'><img src='http://media.cnbc.com/i/CNBC/Components/Email/shareSocialNetworks/twitterIcon.jpg' width='16' height='16' border='0' />&nbsp;Follow us on Twitter</a></li>

              <li style='padding-bottom:5px;'><a href='http://cnbc-emea.tumblr.com/' style='text-decoration:none; color:#3399FF;'><img src='http://media.cnbc.com/i/CNBC/Components/Email/shareSocialNetworks/diggIcon.jpg' width='16' height='16' border='0' />&nbsp;Visit us on Tumblr</a></li>

              </ul>
              </td>
              </tr>
   
</table>
  <input type='button' value='Submit'  onClick='getText();'>
</div>

<p class=MsoNormal><font size=3 face='Times New Roman'><span style='font-size:
12.0pt'><img border=0 width=1 height=1
src='http://cnbc.sparklist.com/db/941246/4606565/1.gif'></span></font></p>

</div>

</body>

</html>";
   	
   	return $alertpreview;
    	
    	
    }
    
function formatDateForPage($d){
	
	date_default_timezone_set('GMT');
	
	$date = explode("-", $d);
	
	//var_dump($date) ;
	
	return date("l, F j, Y",mktime(0,0,0,$date[1],$date[2],$date[0]));   
	
	
}

}