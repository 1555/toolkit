/**
 * @author 127003597 aka Edward Hunton (opps)
 */
 
 var newsletters = {
	 
	 "prefix":String,
	 
	 "init": function (_prefix){
		 
		 newsletters.prefix = _prefix;
prefix = _prefix;
	  

	  
	 // request the top news stack for clickable headlines 
	newsletters.showRSS("europe-newsletter", 'top_stories_list', '0', prefix); 
	// check to see if we are in preview mode - being built in a form
	if(parent != top){
		this.grabIdForCampaigns(prefix);
	  }
	
},

"grabIdForCampaigns": function(prefix){
		var date = window.parent.document.getElementById("date").value;
		var year = date.substring(6,10);
		var month = date.substring(3,5);
		var day = date.substring(0,2);
		var dateForCal = year+month+day;
		var campaign_a_id = window.parent.document.getElementById("banner_a_campaign_id").value; 
		var campaign_b_id = window.parent.document.getElementById("banner_b_campaign_id").value; 
		var url = "http://"+prefix+".cnbceuropeshared.com/public/alerts/index/getapromo/ida/"+campaign_a_id+"/idb/"+campaign_b_id;
		createRequest(); // creates a request using the 'ajax-connection.js' file
		request.open("POST", url, true);
		request.onreadystatechange = this.updateBanners();
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send();
},

"removejscssfile":function(filename, filetype){
	 console.log('remover');
	 var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none"; //determine element type to create nodelist from
	 var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none"; //determine corresponding attribute to test for
	 var allsuspects=document.getElementsByTagName(targetelement);
	 for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
	  if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
	   allsuspects[i].parentNode.removeChild(allsuspects[i]); //remove element by calling parentNode.removeChild()
	 }
	
	},

// manages ajax calls - requires a parameter - the php filters response based on this flag
"showRSS":function(rss_url, element, callNo, prefix) //str
{
	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
	
		newsletters.writeIntoDoc(xmlhttp.responseText, element);
		if(callNo == '0'){
			
		newsletters.showRSS('stocks', 'appearing', '1', prefix);
		} else if(callNo == '1') {
		
		
		} else if(callNo == '2'){
			
			getBanner('a','0'); 
		
		}
   }
  }
xmlhttp.open("GET","http://"+prefix+".cnbceuropeshared.com/public/getrss.php?url="+rss_url,true);
xmlhttp.send();
},



// submit function for the form in cms
"submit": function(){
	shownum = document.getElementById('theValue').value;
	date = document.getElementById('date').value;
	document.forms.newsletter.submit();



},


"addParagraph": function(){ 
	var ni = document.getElementById('fieldset-parasubs');
	var num = 0;
	var numi = document.getElementById('theValue');
	var num = document.getElementById('theValue').value;
	numi.value = parseInt(num)+1;
	var newdiv = document.createElement('li');
  	var divClassName = 'parasubs-'+num+'-'+num;
  	var divName = 'parasubs['+num+']['+num+']';
  	newdiv.setAttribute('id',divClassName);
  	newdiv.setAttribute('name',divName);
	var guest_title = '<guest title>';
	var guest_name = '<guest name>';
	var company_name = '<company name>';
	var date = '<guest title>';
	var topic = '<company topic>';
	newdiv.innerHTML = '<input type="text" name=parasubs[para'+num+'][h2] id=parasubs-para'+num+'-h2 value="<paragraph headline>" size="30"><input type="text" name=parasubs[para'+num+'][p] id=parasubs-para'+num+'-p value="<paragraph>" size="100"><br/><input type="text" name=parasubs[para'+num+'][link] id=parasubs-para'+num+'-link value="<link>" size="100"><input type="text" name=parasubs[para'+num+'][linktext] id=parasubs-para'+num+'-linktext value="<link text>" size="30"><input type="button" value="-" onClick="newsletters.removeAnswer('+num+')"><br/><br/>';
ni.appendChild(newdiv);

	var divtorecieve = document.getElementById('paragraphsubs');

},




// removes a paragrapth if added in the cms
"removeAnswer":function(id){
	
	var show = document.getElementById('parasubs-'+id+'-'+id);
	
	var showParent = document.getElementById('fieldset-parasubs');
	
  showParent.removeChild(show);
 

	
},



"getId":function(){
		
		 var mydiv = document.getElementById("id");
		 var i = mydiv.firstChild.nodeValue;
		 return i;
	},
  
		
		
  
 "gatherValuesAndPreview": function(uri){
  	window.location = uri
  },
  

  
"getCompanyByCampaignId": function(campId, id, callNo) //str
{
	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
		writeCampainBannerIntoDoc(xmlhttp.responseText,campId,id);
		
		if(callNo == '0'){
			
			getBanner('b');
			
		}
    
		
   }
  }
 // alert('before send');
xmlhttp.open("GET","http://"+newsletters.prefix+".cnbceuropeshared.com/public/alerts/index/getcompanybycampaignid/id/"+campId,true);
xmlhttp.send();
},

"getPromoById": function(id) //str
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
		writePromoIntoDoc(xmlhttp.responseText);
		
		
    
		
   }
  };

xmlhttp.open("GET","http://"+newsletters.prefix+".cnbceuropeshared.com/public/alerts/index/getapromohtml/id/"+id,true);
xmlhttp.send();
},
  
"reportrss": function(){
	  
		xml = request.responseText;  
		//alert('xml = '+xml);
	  
  },
  
"writePromoIntoDoc": function(promohtml){
	  

	   var Parent = document.getElementById('promocell');
	   Parent.innerHTML = promohtml;
  },
  
"writeIntoDoc": function(rss_results, element){
	
	  var Parent = document.getElementById(element);
		Parent.innerHTML = rss_results;
		if(element == 'appearing'){
	newsletters.removejscssfile("ajax-connection.js", "js"); //remove all occurences of "ajax-connection.js" on page
	newsletters.removejscssfile("newsletters.js", "js"); //remove all occurences of "newsletters.js" on page	
	newsletters.removejscssfile("newsletters_boot.js", "js"); //remove all occurences of "newsletters.js" on page	
	
		}
	  
	  
  },
  
"writeCampainBannerIntoDoc": function(cid,campid,id){

	  cid = LTrim(cid);
	  if(id == 'a'){
	  var tableStuff = "<p style='font-size:7px;margin:0px'>ADVERTISMENT</p><img src='http://toolkit.cnbceuropeshared.com/public/assets/"+cid+"/campaigns/"+campid+"/images/banner/banner.gif' width='468' height='60' alt='banner_a'>";
	  } else {
		  
		 var tableStuff = "<p style='font-size:7px;margin:0px'>ADVERTISMENT</p><img src='http://toolkit.cnbceuropeshared.com/public/assets/"+cid+"/campaigns/"+campid+"/images/banner/skyscraper.gif' width='160' height='600' alt='banner_b'>";  
	  }
	  
	  var table = document.getElementById("banner_"+id+"_img"); 
	  
	  table.innerHTML = tableStuff;
  },
  
"LTrim":function( value ) {
	
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
},


  



  
  
  

  
"getBanner": function(id, callNo){
	  
	var banVal = window.parent.document.getElementById('banner_'+id+'_campaign_id').value;
	  
	var comp = getCompanyByCampaignId(banVal, id, callNo);
	
	
	  
},
  
"getPromo": function(){
	var promoVal = window.parent.document.getElementById('promo_select').value;
	  var promo = getPromoById(promoVal);
 },
  
  "removeSpaces": function(string) {
 		return string.split(' ').join('');
},

"createInterviewsBlock": function(interviews, interviewsRow){

	for(i=0;i<interviews.length;i++){
		var newRow = interviewsRow;
		
		time = newRow.getElementById('time').innerHTML;
		
		time.innerText = "time test";
		
	}
	
},







  
 "updateBanners":function(){

  	campaign_a_id = window.parent.document.getElementById("banner_a_campaign_id").value;
	campaign_b_id = window.parent.document.getElementById("banner_b_campaign_id").value;
  	company_id = request.responseText;
	var mySplitResult = company_id.split(' ');
	banner_a_loc  = "<a href='http://"+newsletters.prefix+".cnbceuropeshared.com/public/clickcatcher.php?campaigncode="+campaign_a_id+"'><img src='http://"+newsletters.prefix+".cnbceuropeshared.com/public/assets/"+mySplitResult[1]+"/campaigns/"+campaign_a_id+"/images/banner/banner.gif' width=468' height='60' border='0'></a>";
	banner_b_loc  = "<a href='http://"+newsletters.prefix+".cnbceuropeshared.com/public/clickcatcher.php?campaigncode="+campaign_a_id+"'><img src='http://"+newsletters.prefix+".cnbceuropeshared.com/public/assets/"+mySplitResult[2]+"/campaigns/"+campaign_b_id+"/images/banner/skyscraper.gif' width='160' height='600' border='0'></a>";
	img1 = window.document.getElementById("banner_a_image");
	img1.innerHTML = banner_a_loc;
	window.document.getElementById("banner_a_image").parentNode.parentNode.setAttribute('href', '/public/clickcatcher.php?campaigncode='+campaign_a_id);
	

	img2 = window.document.getElementById("banner_b_image");
	img2.innerHTML = banner_b_loc;
	window.document.getElementById("banner_b_image").parentNode.parentNode.setAttribute('href','/public/clickcatcher.php?campaigncode='+campaign_b_id);
	
	
  	
  },
  
"updateBannerB": function(){
  	campaign_b_ids = window.parent.document.getElementById("banner_b_campaign_id").value;
  	company_ids = request.responseText;
	//alert(company_id+" sdfsdfsdf");
	c_ids = removeSpaces(company_id);
	banner_locs  = "http://"+newsletters.prefix+".cnbceuropeshared.com/public/assets/"+c_ids+"/campaigns/"+campaign_a_ids+"/images/banner/banner.gif";
	//alert(banner_loc);
	imgs = window.document.getElementById("banner_b");
	imgParent = window.document.getElementById("banner_b").parentNode;
	//alert(imgParent);
	imgs.src = banner_locs;
	
  	
  },
  
"dump":function(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
},

 }
