/**
 * @author 127003597 aka Edward Hunton (opps)
 */
 
 
 
 var alerts = {
	 
	  "prefix":String,
	 
	 "init":function(_prefix){
	  
alerts.prefix = _prefix;
prefix = _prefix;
	 
	 alerts.showRSS("europe", 'top_stories_list', '0', prefix); 
	 
	// if(parent !== top){
		 alerts.grabInfoFromPage();
	// }
	
	
	
	
	
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
	//// atempt at removeing the onload function call
	/*
	"removeOnLoad":function(){
		console.log('rem onload');
		var unload = document.body.onload = null;
		console.log(unload);
		
	},*/
  
  "grabInfoFromPage":function(){
	  var date = window.parent.document.getElementById("date").value;
	var year = date.substring(6,10);
	var day = date.substring(3,5);
	var month = date.substring(0,2);
	date = day+'/'+month+'/'+year;
	
	var date_ = new Date(date);
	
	var dayname = alerts.getDayName(date_);
	var monthname = alerts.getMonthName(Number(day));
	var daystring = 'Guests Appearing on '+dayname+', '+month+'th '+monthname+' '+year;
	var appearing_tab = document.getElementById('appearing');
	var newHTML = "<td><font face='Arial, Helvetica, sans-serif' color='#005480' size='4'><strong>"+daystring+"</strong></font></td>";
	appearing_tab.innerHTML = newHTML
	var dateForCal = year+month+day;
	var interviews = alerts.gatherInterviews();
	var interviews_tab = document.getElementById("interviews_table");
	for(n=0;n<interviews.length;n++){
	
	    var style_pre;
	    var style_post;
      
			$time = interviews[n][0];
				$hrs = $time.substring(0,2);
				$mins= $time.substring(3,5);
				
				$secs = '00';
				
				$startForCal = dateForCal+'T'+$hrs+$mins+$secs;
				$mins = String(parseInt($mins)+10);
			
				$endForCal = dateForCal+'T'+$hrs+$mins+$secs;
			
				$subject = 'CNBCs '+interviews[n][1]+' show - Special Guest '+interviews[n][2]+' ('+interviews[n][3]+') from '+interviews[n][4]+' on the topic of '+interviews[n][5];
			
				$description = interviews[n][6];
				
				var interviews_tab = document.getElementById('interviews_table');
	            var newRow = interviews_tab.insertRow(interviews_tab.rows.length);
	            newRow.setAttribute('style','color:#005480;font-size:12px;height:auto;vertical-align:text-top;');
	
	// grey cell
	if(n%2){
		
		var col = 'background-color:#DDDDDD;';
		
	} else {
		var col = 'background-color:#FFFFFF;';
	}
	newCell = newRow.insertCell(0);
    newCell.setAttribute('style','padding:20px; font-weight:bold;'+col+' border-width:1;');
	newCell.innerHTML = interviews[n][0]; //'0700';
	
	// white cell
	newCell = newRow.insertCell(1);
    newCell.setAttribute('style','padding:20px; font-weight:bold;'+col+' border-width:0;');
	newCell.innerHTML = interviews[n][1]; //'Squark Box Europe';
	
	// regular font cell
	newCell = newRow.insertCell(2);
    newCell.setAttribute('style','padding:20px; border-width:0;'+col+'');
	newCell.innerHTML = interviews[n][2]; //'Global Head';
	
	newCell = newRow.insertCell(3);
    newCell.setAttribute('style','padding:20px; border-width:0;'+col+'');
	newCell.innerHTML = interviews[n][3]; //'Global Head';
	
	newCell = newRow.insertCell(4);
    newCell.setAttribute('style','padding:20px; border-width:0;'+col+'');
	newCell.innerHTML = interviews[n][4]; //'Global Head';
	
	newCell = newRow.insertCell(5);
    
	
	
	var cellSix = "<a href='http://"+prefix+".cnbceuropeshared.com/public/includes/test.php?start="+$startForCal+"&end="+$endForCal+"&subject="+$subject+"&description="+$description+"'><img src='http://"+prefix+".cnbceuropeshared.com/public/guest_alert/add_btn.jpg' border=0 width='41' height='19' alt='add'></a>";
	newCell.innerHTML = cellSix; //'Global Head';
	 newCell.setAttribute('style','padding:20px; border-width:0;'+col+'');
			
	
        interviews_tab.appendChild(newRow);
		
		
		
	}
	
	
	
	
	campaign_a_id = window.parent.document.getElementById("banner_a_campaign_id").value; //****************************************************
	//alert(campaign_a_id);
	campaign_b_id = window.parent.document.getElementById("banner_b_campaign_id").value; //****************************************************
	
	var url = "http://"+prefix+".cnbceuropeshared.com/public/alerts/index/getapromo/ida/"+campaign_a_id+"/idb/"+campaign_b_id;
	//alert(url);
	
	createRequest();
	request.open("POST", url, true);
	//alert('before send');
	request.onreadystatechange = alerts.updateBanners;
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	//alert('before send');
	request.send();
	  
  },
 


"inishCreator": function(){
	var numi = document.getElementById('theValue');
	numi.setAttribute('value','0');
},



"formatDate":function (input) {
  var datePart = input.match(/\d+/g),
  year = datePart[2], // get only two digits
  month = datePart[1], 
  day = datePart[0];
  return month+'/'+day+'/'+year;
},

// make a request to guest tracker for the shows
"populateShows": function(_prefix){
	prefix = _prefix;
	
		$_date = document.getElementById('date').value;
		$date = alerts.formatDate ($_date); // "18/01/10"
	
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
		
		//alert(xmlhttp.responseText);
		var newshows = alerts.extractDataFromShows(xmlhttp.responseText);
		for(var x = 1; x<newshows.length; x++){
		alerts.addShow(x, 1, newshows[x-1]);
		}
	}
  }
	//alert($date);
	xmlhttp.open("GET","http://"+prefix+".cnbceuropeshared.com/public/getrss.php?url=shows&date="+$date,true);
	xmlhttp.send();
	
},


"extractDataFromShows": function(showsString){
	//alert('get shows');
	
				var shows = [];

				var words = [];
				var word = "";
				for(var x = 0;x < showsString.length; x++){
					if(showsString[x] == '*'){
						//alert(x);
				for(var n = x+1;n < showsString.length; n++){
					
					if(showsString[n] != '#' && showsString[n] != '@' && showsString[n] != '~' && showsString[n] != '"'){
						//alert(showsString[i]);
						word+=showsString[n];
						//alert(word);
					} else if(showsString[n] == '#') {
						//alert(word);
						words.push(word);
						word = "";
					} else if(showsString[n] == '@'){
						//alert(words);
						shows.push(words);
						word = "";
						words = [];
					}
			//	
				}
					}
				}
				
//alert(shows);
	return shows;
	
},

"removeHead":function(){
	var doc = document;
	
	var head = document.getElementsByTagName('head')[0];
	
	var rems = head.parentNode.removeChild(head);
	
	
	
	
},

"injectPromo":function(){ // not used in the preview but to collect from drop down and inject into the editor box

	img = document.getElementById('promo_select').options[document.getElementById('promo_select').selectedIndex].value;
	promotitle = document.getElementById('promo_select').options[document.getElementById('promo_select').selectedIndex].text;
	
	promoIdDiv = document.getElementById('promoValue')
	promoIdDiv.value = img;
	createRequest();
	var url = "http://"+alerts.prefix+".cnbceuropeshared.com/public/alerts/index/getapromohtml/id/"+img;
		     request.open("POST", url, true);
		        // alert("before send");
			 request.onreadystatechange = alerts.updatePromoBox;
			 request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		//     alert("before send");
			 request.send();
},

"updatePromoBox": function(){
	var newTotal = request.responseText;
	pDiv = document.getElementById('promotitle');
	promotitle = document.getElementById('promo_select').options[document.getElementById('promo_select').selectedIndex].text;
	pDiv.value = promotitle;
	
    document.getElementById('promoBod-Editor_iframe').contentWindow.document.body.innerHTML = newTotal;
},

// used when alert is being built in the cms
"submit":function(){
	
	shownum = document.getElementById('theValue').value;
	//alert(shownum+"is the show num");
	date = document.getElementById('date').value;
	
	promo_select = document.forms['alert'].elements['promo_select'].value;
	banner_a_campaign_id = document.forms['alert'].elements['banner_a_campaign_id'].value;
	banner_b_campaign_id= document.forms['alert'].elements['banner_b_campaign_id'].value;
	var incomplete = '0';
	//alert($date);
	if(date == undefined){
		incomplete = '1';
		//alert("no name");
		document.forms.alert.date.style.backgroundColor="#ff0000"
	}
	if(banner_a_campaign_id  == '0'){
		incomplete = '1';
		//alert("no name");
		document.forms['alert'].elements['banner_a_campaign_id'].style.backgroundColor="#ff0000"
	}
	if(banner_b_campaign_id  == '0'){
		incomplete = '1';
		//alert("no name");
		document.forms['alert'].elements['banner_b_campaign_id'].style.backgroundColor="#ff0000"
	}
	if(promo_select  == '0'){
		incomplete = '1';
		//alert("no name");
		document.forms['alert'].elements['promo_select'].style.backgroundColor="#ff0000"
	}
	
	shownum = document.getElementById('theValue').value;
	
	for(var i = 0;i<=(shownum-i);i++){
		
	
	guestname = document.getElementById('showssubs-guest'+i+'-guestname').value;

	guesttitle = document.getElementById('showssubs-guest'+i+'-guesttitle').value;

	companytitle= document.getElementById('showssubs-guest'+i+'-companyname').value;

	showtopic = document.getElementById('showssubs-guest'+i+'-topic').value;

	if(guestname =="<guest name>"){
	//	alert("no guestname");
		incomplete = '1';
		div = document.getElementById('showssubs-guest'+i+'-guestname');
		div.style.backgroundColor="#ff0000";
	}
	//alert(incomplete);
	if(guesttitle =="<guest title>"){

		incomplete = '1';
		div = document.getElementById('showssubs-guest'+i+'-guesttitle');
		div.style.backgroundColor="#ff0000";
	}

	if(companytitle =="<company name>"){

		incomplete = '1';
		div = document.getElementById('showssubs-guest'+i+'-companyname');
		div.style.backgroundColor="#ff0000";
	}

	if(showtopic =="<topic>"){

		incomplete = '1';
		div = document.getElementById('showssubs-guest'+i+'-topic');
		div.style.backgroundColor="#ff0000";
	}

}


if(incomplete == '0'){

	document.forms.alert.submit();
}



},




"unhighlight":function(div){
	//alert(div);
	if(div == 'pollname'){
			var mydiv = document.forms.createpoll.pollname;
	}
	if(div == 'polldescription'){
			var mydiv = document.forms.createpoll.polldescription;
	}
	if(div == 'pollquestion'){
			var mydiv = document.forms.createpoll.pollquestion;
	}
	
	
	mydiv.style.backgroundColor="#FFFFFF"
},


"getTimeFromTimeDateString":function(tstring){

	for(var x = 0; x < tstring.length; x++){
		if(tstring[x] == ' '){
			
			var hrs = tstring.substr(x+1,2);
			var mins = tstring.substr(x+4,2);
			
			return [hrs, mins];
		}
	}
},


"addShow":function(mynum, populate, show){ //mynum, populate, show
	
	var ni = document.getElementById('fieldset-showssubs');
	var num = 0;
	var numi = document.getElementById('theValue');
	var num = document.getElementById('theValue').value;
	numi.value = parseInt(num)+1;

	var newdiv = document.createElement('li');
	
	if(mynum == 0){num+=20000;}
  	var divClassName = 'showssubs-'+num+'-'+num;
  	var divName = 'showssubs['+num+']['+num+']';
  	newdiv.setAttribute('id',divClassName);
  	newdiv.setAttribute('name',divName);
	var capcon = '';
	var squark = '';
	var investingedge = '';
	var wwexchange = '';
	var euroclosingbell = '';
	var europethisweek = '';
	var strickly = '';
	
	var four = '';
	var five = '';
	var six = '';
	var seven = '';
	var eight = '';
	var nine = '';
	var ten = '';
	var eleven = '';
	var twelve = '';
	var thirteen = '';
	var fourteen = '';
	var fifteen = '';
	var sixteen = '';
	var seventeen = '';
	var eighteen = '';
	var nineteen = '';
	var twenty = '';
	var twentyone = '';
	var twentytwo = '';
	var twentythree = '';
	var twentyfour = '';
	var min_00 = '';
	var min_05 = '';
	var min_10 = '';
	var min_15 = '';
	var min_20 = '';
	var min_25 = '';
	var min_30 = '';
	var min_35 = '';
	var min_40 = '';
	var min_45 = '';
	var min_50 = '';
	var min_55 = '';
	
	

	if(populate == 1){
		var time = alerts.getTimeFromTimeDateString(show[5]);
		//alert(show[0]);
		if(show[0] == 'SQUAWK BOX EUROPE'){squark ='SELECTED'};
		if(show[0] == 'INVESTING EDGE'){investingedge = 'SELECTED'};
		if(show[0] == 'CAPITAL CONNECTION'){capcon = 'SELECTED'};
		if(show[0] == 'WORLDWIDE EXCHANGE'){wwexchange = 'SELECTED'};
		if(show[0] == 'EUROPEAN CLOSING BELL'){euroclosingbell = 'SELECTED'};
		if(show[0] == 'EUROPE THIS WEEK'){europethisweek = 'SELECTED'};
		
		
		/// hrs
		if(time[0] == '04'){four = 'SELECTED'};
		if(time[0] == '05'){five = 'SELECTED'};
		if(time[0] == '06'){six = 'SELECTED'};
		if(time[0] == '07'){seven = 'SELECTED'};
		if(time[0] == '08'){eight = 'SELECTED'};
		if(time[0] == '09'){nine = 'SELECTED'};
		if(time[0] == '10'){ten = 'SELECTED'};
		if(time[0] == '11'){eleven = 'SELECTED'};
		if(time[0] == '12'){twelve = 'SELECTED'};
		if(time[0] == '13'){thirteen = 'SELECTED'};
		if(time[0] == '14'){fourteen= 'SELECTED'};
		if(time[0] == '15'){fifteen = 'SELECTED'};
		if(time[0] == '16'){sixteen = 'SELECTED'};
		if(time[0] == '17'){seventeen = 'SELECTED'};
		if(time[0] == '18'){eighteen = 'SELECTED'};
		if(time[0] == '19'){nineteen = 'SELECTED'};
		if(time[0] == '20'){twenty = 'SELECTED'};
		if(time[0] == '21'){twentyone = 'SELECTED'};
		if(time[0] == '22'){twentytwo = 'SELECTED'};
		if(time[0] == '23'){twentythree = 'SELECTED'};
		if(time[0] == '24'){twentyfour = 'SELECTED'};
		//// mins
		if(time[1] == '00'){min_00 = 'SELECTED'};
		if(time[1] == '05'){min_05 = 'SELECTED'};
		if(time[1] == '10'){min_10 = 'SELECTED'};
		if(time[1] == '15'){min_15 = 'SELECTED'};
		if(time[1] == '20'){min_20 = 'SELECTED'};
		if(time[1] == '25'){min_25 = 'SELECTED'};
		if(time[1] == '30'){min_30 = 'SELECTED'};
		if(time[1] == '35'){min_35 = 'SELECTED'};
		if(time[1] == '40'){min_40 = 'SELECTED'};
		if(time[1] == '45'){min_45 = 'SELECTED'};
		if(time[1] == '50'){min_50 = 'SELECTED'};
		if(time[1] == '55'){min_55 = 'SELECTED'};
	
	
		var guest_name = String(show[2]+" "+show[1]);

		var guest_title = show[3];
	
		var company_name = show[4];
		var date = show[5];
		var topic = show[6];
		
		newdiv.innerHTML = '<SELECT name=showssubs[guest'+num+'][show_id] id=showssubs-guest'+num+'-show_id><OPTION >Capital Connection</OPTION><OPTION '+squark+'>Squawk Box</OPTION><OPTION '+investingedge+'>Investing Edge</OPTION><OPTION '+wwexchange+'>Worldwide Exchange</OPTION><OPTION '+euroclosingbell+'>European Closing Bell</OPTION><OPTION '+europethisweek+'>Europe This Week</OPTION><OPTION>The Tonight Show with Jay Leno</OPTION><OPTION>11pm slot</OPTION></SELECT><SELECT NAME=showssubs[guest'+num+'][hrs] ID=showssubs-guest'+num+'-hrs ><OPTION '+four+'>04</OPTION><OPTION '+five+'>05</OPTION><OPTION '+six+'>06</OPTION><OPTION '+seven+'>07</OPTION><OPTION '+eight+'>08</OPTION><OPTION '+nine+'>09</OPTION><OPTION '+ten+'>10</OPTION><OPTION '+eleven+'>11</OPTION><OPTION '+twelve+'>12</OPTION><OPTION '+thirteen+'>13</OPTION><OPTION '+fourteen+'>14</OPTION><OPTION '+fifteen+'>15</OPTION><OPTION '+sixteen+'>16</OPTION><OPTION '+seventeen+'>17</OPTION><OPTION '+eighteen+'>18</OPTION><OPTION '+nineteen+'>19</OPTION><OPTION '+twenty+'>20</OPTION><OPTION '+twentyone+'>21</OPTION><OPTION '+twentytwo+'>22</OPTION><OPTION '+twentythree+'>23</OPTION><OPTION '+twentyfour+'>24</OPTION></SELECT><SELECT NAME=showssubs[guest'+num+'][mins] ID=showssubs-guest'+num+'-mins><OPTION '+min_00+'>00</OPTION><OPTION '+min_05+'>05</OPTION><OPTION '+min_10+'>10</OPTION><OPTION '+min_15+'>15</OPTION><OPTION '+min_20+'>20</OPTION><OPTION '+min_25+'>25</OPTION><OPTION '+min_30+'>30</OPTION><OPTION '+min_35+'>35</OPTION><OPTION '+min_40+'>40</OPTION><OPTION '+min_45+'>45</OPTION><OPTION '+min_50+'>50</OPTION><OPTION '+min_55+'>55</OPTION></SELECT><input type="text" name=showssubs[guest'+num+'][guestname] id=showssubs-guest'+num+'-guestname value="'+guest_name+'" size="15"><input type="text" name=showssubs[guest'+num+'][guesttitle] id=showssubs-guest'+num+'-guesttitle value="'+guest_title+'" size="15" ><input type="text" name=showssubs[guest'+num+'][companyname] value="'+company_name+'" id=showssubs-guest'+num+'-companyname size="15" ><input type="text" name=showssubs[guest'+num+'][topic] value="'+topic+'" id=showssubs-guest'+num+'-topic size="15"><input type="button" value="-" onClick="alerts.removeAnswer('+num+')"><textarea name=showssubs[guest'+num+'][description] id=showssubs-guest'+num+'-description cols="95" rows="3">-- Description for alert in calendar --</textarea></li><br>';
		
	} else if(populate == '0') {
		//alert('else');
		var guest_title = '<guest title>';
		var guest_name = '<guest name>';
		var company_name = '<company name>';
		var date = '<guest title>';
		var topic = '<company topic>';
		
		newdiv.innerHTML = '<SELECT name=showssubs[guest'+num+'][show_id] id=showssubs-guest'+num+'-show_id><OPTION >Capital Connection</OPTION><OPTION>Squawk Box</OPTION><OPTION>Investing Edge</OPTION><OPTION>Worldwide Exchange</OPTION><OPTION>European Closing Bell</OPTION><OPTION>Europe This Week</OPTION><OPTION>The Tonight Show with Jay Leno</OPTION><OPTION>11pm slot</OPTION></SELECT><SELECT NAME=showssubs[guest'+num+'][hrs] ID=showssubs-guest'+num+'-hrs ><OPTION>04</OPTION><OPTION>05</OPTION><OPTION>06</OPTION><OPTION>07</OPTION><OPTION>08</OPTION><OPTION>09</OPTION><OPTION>10</OPTION><OPTION>11</OPTION><OPTION>12</OPTION><OPTION>13</OPTION><OPTION>14</OPTION><OPTION>15</OPTION><OPTION>16</OPTION><OPTION>17</OPTION><OPTION>18</OPTION><OPTION>19</OPTION><OPTION>20</OPTION><OPTION>21</OPTION><OPTION>22</OPTION><OPTION>23</OPTION><OPTION>24</OPTION></SELECT><SELECT NAME=showssubs[guest'+num+'][mins] ID=showssubs-guest'+num+'-mins><OPTION>00</OPTION><OPTION>05</OPTION><OPTION>10</OPTION><OPTION>15</OPTION><OPTION>20</OPTION><OPTION>25</OPTION><OPTION>30</OPTION><OPTION>35</OPTION><OPTION>40</OPTION><OPTION>45</OPTION><OPTION>50</OPTION><OPTION>55</OPTION></SELECT><input type="text" name=showssubs[guest'+num+'][guestname] id=showssubs-guest'+num+'-guestname value="<guest name>" size="15"><input type="text" name=showssubs[guest'+num+'][guesttitle] id=showssubs-guest'+num+'-guesttitle size="15" value="<guest title>" ><input type="text" name=showssubs[guest'+num+'][companyname] id=showssubs-guest'+num+'-companyname size="15" value="<company name>"><input type="text" name=showssubs[guest'+num+'][topic]  value="<topic>" id=showssubs-guest'+num+'-topic size="15"><input type="button" value="-" onClick="removeAnswer('+num+')"><textarea name=showssubs[guest'+num+'][description] id=showssubs-guest'+num+'-description cols="95" rows="3">-- Description for alert in calendar --</textarea></li><br>';
	}
	
  	
	
  	ni.appendChild(newdiv);

	var divtorecieve = document.getElementById('show');

},






"validateForm":function(preview){
//alert(preview);
	
	if(preview == '1'){
		//alert('ploc');
		var location = window.parent.document;
	}else {
		//alert('dloc');
		var location = document;
	}
	//alert('beyon ploc');
	
	incomplete = '0';
	
	
	
	$shownum = location.getElementById('theValue').value;
	
	
	
	var incomplete = '0';

		for(var i = 1;i<$shownum+1;i+=1){
			
			//alert(i);

		guestname = location.getElementById('guestname'+i).value;
		guesttitle = location.getElementById('guesttitle'+i).value;
		companytitle= location.getElementById('companytitle'+i).value;
		showtopic = location.getElementById('showtopic'+i).value;
		
		//alert(guestname);
		
		if(guestname =="guest name"){
			incomplete = '1';
			div = location.getElementById('guestname'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(guesttitle =="guest title"){
			incomplete = '1';
			div = location.getElementById('guesttitle'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(companytitle =="company name"){
			incomplete = '1';
			div = location.getElementById('companytitle'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(showtopic =="topic"){
			incomplete = '1';
			div = location.getElementById('showtopic'+i);
			div.style.backgroundColor="#ff0000";
		}
		
	}
	
	
	
	if(preview == '0'){ // do not submit in context of preview
			if(incomplete == '0'){
			
				location.forms.createalert.submit();
			}
	
	}

	
	return incomplete;
	
	// make sure there is at least 2 answers
	
},



"getInterviewRow":function(time, show, name_tittle, name_tittle){
	//alert('getInterviewRow');
	var newRow = "<tr><td >"+time+"</td><td>"+show+"</td><td>"+name_tittle+"</td><td>"+name_tittle+"</td></tr>";
	return newRow;
},

"removeAnswer":function(id){
	
	var show = document.getElementById('showssubs-'+id+'-'+id);
	//alert(ni)
	var showParent = document.getElementById('fieldset-showssubs');

  showParent.removeChild(show);
 

	
},





  
"showRSS": function(rss_url, element, callNo, prefix) //str
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
		

		alerts.writeIntoDoc(xmlhttp.responseText, element);
		if(callNo == '0'){
			
		alerts.showRSS("blogs", 'blogs_list', '1', prefix);
		//alert(callNo);
  		//document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
	
	
		} else if(callNo == '1') {
		
		} else if(callNo == '2'){
	//	alert('we made 2');
			
			getBanner('a','0'); 
		
		}
   }
  }
  //alert('rss call'+rss_url);
xmlhttp.open("GET","http://"+prefix+".cnbceuropeshared.com/public/getrss.php?url="+rss_url,true);
xmlhttp.send();
},
  
"getCompanyByCampaignId":function(campId, id, callNo) //str
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
xmlhttp.open("GET","http://"+prefix+".cnbceuropeshared.com/public/alerts/index/getcompanybycampaignid/id/"+campId,true);
xmlhttp.send();
},

"getPromoById":function(id) //str
{
	//alert('get p'+id);
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
  }

xmlhttp.open("GET","http://"+prefix+".cnbceuropeshared.com/public/alerts/index/getapromohtml/id/"+id,true);
xmlhttp.send();
},
  
"reportrss":function(){
	  
		xml = request.responseText;  
		//alert('xml = '+xml);
	  
  },
  
"writePromoIntoDoc":function(promohtml){
	

	   var Parent = document.getElementById('promos');
	
	   Parent.innerHTML = promohtml;
	
  },
  
  "writeIntoDoc":function(rss_results, element){

	  var Parent = document.getElementById(element);
	 Parent.innerHTML = rss_results;
	 


if(element == 'blogs_list'){
	
	if(parent !== top){
		alerts.getPromo();
		
	 } else {
		alerts.removejscssfile("ajax-connection.js", "js"); //remove all occurences of "ajax-connection.js" on page
	alerts.removejscssfile("alerts.js", "js"); //remove all occurences of "newsletters.js" on page	 
	alerts.removejscssfile("alerts_boot.js", "js"); //remove all occurences of "newsletters.js" on page	 
	
	 }
}
	
	
	
	  
	  
  },
  
"writeCampainBannerIntoDoc":function(cid,campid,id){
	
	  cid = LTrim(cid);
	
	  if(id == 'a'){
	  var tableStuff = "<p style='font-size:7px;margin:0px'>ADVERTISMENT</p><img src='http://"+prefix+".cnbceuropeshared.com/public/assets/"+cid+"/campaigns/"+campid+"/images/banner/banner.gif' width='468' height='60' alt='banner_a'>";
	  } else {
		  
		 var tableStuff = "<p style='font-size:7px;margin:0px'>ADVERTISMENT</p><img src='http://"+prefix+".cnbceuropeshared.com/public/assets/"+cid+"/campaigns/"+campid+"/images/banner/skyscraper.gif' width='160' height='600' alt='banner_b'>";  
	  }
	  
	  var table = document.getElementById("banner_"+id+"_img"); 
	  
	  table.innerHTML = tableStuff;
  },
  
"LTrim":function( value ) {
	
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
},


  


"getDayName":function(date) {
	//alert('d called');
var d = ['Sunday','Monday','Tuesday','Wednesday',
'Thursday','Friday','Saturday'];
return d[date.getDay()];
},


"getMonthName":function(month) {
	//alert(month+' m called');
var m = ['January','February','March','April','May','June','July',
'August','September','October','November','December'];
//alert(m[month-1]);
return m[month-1];
} ,
  
  
  

  
 "getBanner":function(id, callNo){
	  
	 // alert('getban'+id);
	  
	  var banVal = window.parent.document.getElementById('banner_'+id+'_campaign_id').value;
	  
	//  alert(banVal);
	  
	  var comp = getCompanyByCampaignId(banVal, id, callNo);
	  
	//  writeCampainBannerIntoDoc(comp,banVal,id);
	  
	  
  },
  
"getPromo":function(){
//alert('getp');


	  
	  var promoVal = window.parent.document.getElementById('promo_select').value;
	  
	  
 	 // alert(promoVal+' is the promo val');
	  
	  var promo = getPromoById(promoVal);
	  
	//  writeCampainBannerIntoDoc(comp,banVal,id);
	
	  
	  
  },
  
"removeSpaces":function(string) {
 		return string.split(' ').join('');
},

"createInterviewsBlock":function(interviews, interviewsRow){
	
	for(i=0;i<interviews.length;i++){
		var newRow = interviewsRow;
		
		time = newRow.getElementById('time').innerHTML;
		
		time.innerText = "time test";
	
	}
	
},

"gatherPromo":function(){
	
	//**************************** This version finds the id and gets the pieces out of the database
	
	var promoid = window.parent.document.getElementById('promoBod-Editor_iframe').value
	
	
	//************************** This version is for when we pull html from the WSIWIG
//promoHTML = window.parent.document.getElementById('promoBod-Editor_iframe').contentWindow.document.body.innerHTML;
 //alert(promoHTML+' is the promo html');
 
//	 promoDiv = document.getElementById('promo');
	// alert(promoDiv);
//	promoDiv.innerHTML = promoHTML;
	 
	 //*************************************** This version collects from the database based on the drop down selection
	 
	 
},

"gatherInterviews":function(){
	//alert('gather');
	numberofshows = parseInt(window.parent.document.getElementById("theValue").value);
	var interviews=new Array();
	
	var n = 0;
//	alert(numberofshows);
	if (numberofshows > 0) {
		for (n = 0; n < numberofshows; n++) {
			//alert(window.parent.document.getElementById("showssubs-guest" + n + "-hrs").value);
			if(window.parent.document.getElementById("showssubs-guest" + n + "-hrs")){ // check to make sure it hasn'ty been remoived after population
		//	alert(n);
			var interview=new Array();
			interview[0] = window.parent.document.getElementById("showssubs-guest" + n + "-hrs").value+':'+window.parent.document.getElementById("showssubs-guest" + n + "-mins").value;
			interview[1] = window.parent.document.getElementById("showssubs-guest" + n + "-show_id").value;
			interview[2] = window.parent.document.getElementById("showssubs-guest" + n + "-guestname").value;
			interview[3] = window.parent.document.getElementById("showssubs-guest" + n + "-guesttitle").value;
			interview[4] = window.parent.document.getElementById("showssubs-guest" + n + "-companyname").value;
			interview[5] =window.parent.document.getElementById("showssubs-guest" + n + "-topic").value;
			//alert(window.parent.document.getElementById("showssubs-guest" + n + "-topic").value);
			interview[6] =window.parent.document.getElementById("showssubs-guest" + n + "-description").value;
			//alert(window.parent.document.getElementById("showssubs-guest" + n + "-description").value);
			
		//	alert(interview);
			interviews.push(interview);
			}
			
		}
		
	}
//	alert(interviews);
//getPromo(); 
	return interviews;
	
	
	
},



  
"updateBanners":function(){
  	campaign_a_id = window.parent.document.getElementById("banner_a_campaign_id").value;
	campaign_b_id = window.parent.document.getElementById("banner_b_campaign_id").value;
  	company_id = request.responseText;

	var mySplitResult = company_id.split(' ');

	banner_a_loc  = "<a href='http://"+prefix+".cnbceuropeshared.com/public/clickcatcher.php?campaigncode="+campaign_a_id+"'><img src='http://"+prefix+".cnbceuropeshared.com/public/assets/"+mySplitResult[1]+"/campaigns/"+campaign_a_id+"/images/banner/banner.gif' width=468' height='60' border='0'></a>";
	banner_b_loc  = "<a href='http://"+prefix+".cnbceuropeshared.com/public/clickcatcher.php?campaigncode="+campaign_a_id+"'><img src='http://"+prefix+".cnbceuropeshared.com/public/assets/"+mySplitResult[2]+"/campaigns/"+campaign_b_id+"/images/banner/skyscraper.gif' width='160' height='600' border='0'></a>";

	img1 = window.document.getElementById("banner_a_image");
	img1.innerHTML = banner_a_loc;
	window.document.getElementById("banner_a_image").parentNode.parentNode.setAttribute('href', '/public/clickcatcher.php?campaigncode='+campaign_a_id);
	//alert(img1);
	

	img2 = window.document.getElementById("banner_b_image");
	img2.innerHTML = banner_b_loc;
	window.document.getElementById("banner_b_image").parentNode.parentNode.setAttribute('href','/public/clickcatcher.php?campaigncode='+campaign_b_id);
	//alert(imgParent2);
	
  	
  },
  
"updateBannerB":function(){
  	campaign_b_ids = window.parent.document.getElementById("banner_b_campaign_id").value;
  	company_ids = request.responseText
	//alert(company_id+" sdfsdfsdf");
	c_ids = removeSpaces(company_id);
	banner_locs  = "http://"+prefix+".cnbceuropeshared.com/public/assets/"+c_ids+"/campaigns/"+campaign_a_ids+"/images/banner/banner.gif";
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

"dateString":function(day, month ){
	 calendar = new Date();
	 //alert(calendar);
			 day = calendar.getDay();
			 //alert(day);
			 month = calendar.getMonth();
			 //alert(month );
			 date = calendar.getDate();
			//alert(date);
			 year = calendar.getYear();
			//alert(year);
			 if (year < 1000)
			 year+=1900
			 cent = parseInt(year/100);
			 g = year % 19;
			 k = parseInt((cent - 17)/25);
			 i = (cent - parseInt(cent/4) - parseInt((cent - k)/3) + 19*g + 15) % 30;
			 i = i - parseInt(i/28)*(1 - parseInt(i/28)*parseInt(29/(i+1))*parseInt((21-g)/11));
			 j = (year + parseInt(year/4) + i + 2 - cent + parseInt(cent/4)) % 7;
			 l = i - j;
			 emonth = 3 + parseInt((l + 40)/44);
			 edate = l + 28 - 31*parseInt((emonth/4));
			 emonth--;
			 var dayname = new Array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
			 var monthname = 
			 new Array ("January","February","March","April","May","June","July","August","September","October","November","December" );
			 document.write(dayname[day] + ", ");
			 document.write(monthname[month] + " ");
			 if (date< 10) document.write("0" + date + ", ");
					 else document.write(date + ", ");
			 document.write(year);
	
}

 }
