<p>&nbsp;</p>
<p>&nbsp;</p>
<?php

class Zend_View_Helper_Promopreview extends Zend_View_Helper_Abstract
{
    public function promopreview(){
    	
    	 //$prefix =  $this->baseUrl();
	  $prefix =  $_SERVER['SCRIPT_NAME'];
    	$bannerA = $this->view->bannerA;
		$bannerB = $this->view->bannerB;
    	  $alert = $this->view->alert;
    	 $shows = $this->view->shows;
		 if(isset($this->view->promo)){
		  $promo = $this->view->promo;
		 } else {
		  unset($promo);
			 
	 }
    	
    	  $pdate = $this->formatDateForPage($alert['date']);
    	  
 // var_dump($promo);
    	
    //testcall()	  
    	  $alertpreview = "<html><head><script type='text/javascript' src='$prefix/js/cnbc/promos.js'></script></head><body onLoad='grab();'>Test me up 2
</body>
</html>";

return $alertpreview;


	}
	function formatDateForPage($d){
	
	date_default_timezone_set('GMT');
	
	$date = explode('-', $d);
	
	//var_dump($date) ;
	
	return date('l, F j Y',mktime(0,0,0,$date[1],$date[2],(int)$date[0]));   //strtoupper(
	
	
}
}