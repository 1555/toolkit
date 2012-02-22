/**
 * @author 127003597 aka Edward Hunton (opps)
 */

function inishCreator(){
	var numi = document.getElementById('theValue');
	numi.setAttribute('value','0');
}

function testCall(){
	//alert("called");
	
}

function viewPreview(id){
	//window.open('popup.html', 'windowname1', 'width=200, height=77');  
	//return false;
}

function copyimgageloc(loc){
	//alert(loc);
}

function imageForCampaign(comp){
	//alert(comp);
	location.href='http://toolkit.cnbceuropeshared.com/public/campaigns/index/uploadimages/company/'+comp;
}




function unhighlight(div){
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
	
	//alert(mydiv);
	mydiv.style.backgroundColor="#FFFFFF"
	 //var ni = document.getElementById(div);
}

function addImage(mynum, company){
	//alert("add called"+mynum);
	//var ni = document.getElementById('fieldset-shows');
	var ni = document.getElementById('fieldset-images');
	var num = 0;
	var numi = document.getElementById('theValue');
	var num = (document.getElementById('theValue').value -1)+ 2;
	
	//alert(num);
	//alert(numi);
	//if(numi.value != '20000'){
		numi.value = num;
	//} 
	var newdiv = document.createElement('li');
	//alert(newdiv);
	if(mynum == 0){num+=20000;}
  	var divClassName = 'imagesubs-'+num+'-'+num;
  	var divName = 'imagesubs['+num+']['+num+']';
  	newdiv.setAttribute('id',divClassName);
  	newdiv.setAttribute('name',divName);
	newdiv.innerHTML = '<label for=imagesubs-'+num+'>File: </label><input type=file name=imagesubs-'+num+'-file id=imagesubs['+num+'][file] class="genText" size="80"><br/>';
	
	newdiv.innerHTML = newdiv.innerHTML+ '<label for=imagesubs-'+num+'>Alternative Text (displays when images are not downloaded):</label><input type=text name=imagesubs['+num+'][alt] id=imagesubs-'+num+'-alt size="40"><br/>';
	
	newdiv.innerHTML = newdiv.innerHTML+ '<label for=imagesubs-'+num+'>Description: </label><input type=text name=imagesubs['+num+'][desc] id=imagesubs-'+num+'-desc size="85"><br/><br/>';
	
	//newdiv.innerHTML = newdiv.innerHTML+ '<input type=text name=imagesubs['+num+'][newname] id=imagesubs-'+num+'-newname><label for=imagesubs-'+num+'>Name</label>';
	
	if(company){
	newdiv.innerHTML = newdiv.innerHTML+ '<select name=imagesubs['+num+'][newname] id=imagesubs-'+num+'-newname><OPTION>Test</OPTION></select><label for=imagesubs-'+num+'>Company</label>';
	}
	//newdiv.innerHTML = newdiv.innerHTML+ '<input type=radio name=imagesubs['+num+'][type] id=imagesubs-'+num+'-banner value=banner><label for=imagesubs-'+num+'>Banner</label>';
	
		//newdiv.innerHTML = newdiv.innerHTML+ '<input type=radio name=imagesubs['+num+'][type] id=imagesubs-'+num+'-skyscraper value=skyscraper><label for=imagesubs-'+num+'>Skyscraper</label>';
	
	
	//ert(newdiv);
  	ni.appendChild(newdiv);

	var divtorecieve = document.getElementById('image');

}

function setLive(pollid,live){
	
	//switch(live){
		
		//case 'closed':
		var answer = confirm("You are about to alter the status of this poll. Once live do not edit further if you know it is being used on the site");
		//break;
		
		//case 'live':
	//	var answer = confirm("You are about to set this poll to live. Do not remove answers whilst in this mode");
	//	break;
		
		//case 'development':
		//var answer = confirm("Only set to 'development' if the poll is not in use on the site");
		//break;
		
	
	
	if (answer) {
	
		createRequest();
		//$random = Math.random();
		var url = "setLives.php";
		request.open("POST", url, true);
		request.onreadystatechange = updateTable;
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send("poll=" + pollid + "&live=" + live);
		var ni = document.getElementById('edit' + pollid);
		if (live != 'development') {
			ni.style.visibility = 'hidden'
		}
		else {
			ni.style.visibility = 'visible'
		}
	}else {
		createRequest();
		//alert('in answer');
		//$random = Math.random();
		var url = "setLives.php";
		request.open("POST", url, true);
		request.onreadystatechange = updateselected;
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send("poll=" + pollid);
	}
		
	
	
	
}

function updateTable(){
	
	
}

function catchSpinnerchange(target){
//alert(target);
	//alert(document.getElementById('alertbanner').value);
	company = document.getElementById('company_id').value;
	//alert(company);
	img = document.getElementById(target+'_id').options[document.getElementById(target+'_id').selectedIndex].text;
	//alert(img);
	//alert(document.getElementById('company_id').options[num].value);
	mydiv = document.getElementById(target);
	//alert(mydiv);
	newImage = "<img src='/public/assets/"+company+"/images/volt/"+img+"' />";
	//alert(newImage);
	//newImage = "<img src='/public/assets/"+company+"/images/volt/"+img+"' width=400 />";
	mydiv.innerHTML = newImage;
	//alert(mydiv.innerHTML);
}

function updateselected(){
	
	// responsetext is a string value with an '&' symbol in it, live value one side, pollid the other
	var p = getPoll(request.responseText);
	var s = getStatus(request.responseText);
	//alert(p+" is p");
	//alert(s+"is s");
	var mydiv = document.getElementById('status'+p);
	//alert(mydiv)
	mydiv.selectedIndex = 0;
	
	
}

function getPoll(res){
	//alert(res+" is res");
	var from = res.indexOf('&', 0);
	//alert(from);
	return res.slice(from+1);
}

function getStatus(res){
	//alert('getStatus');
	var from = res.indexOf('&', 0);
	//alert(from);
	return res.slice(0,from);
}

function validateForm(){
	incomplete = '0';
	//alert("called from campain form");
	$shownum = document.getElementById('theValue').value;
	//alert($shownum);
	$startdate = document.getElementById('startdate').value;
//	alert($startdate);
	$enddate = document.getElementById('enddate').value;
//	alert($enddate);
	$title = document.getElementById('title').value;
	
	$banner = document.getElementById('banner_id').value;
	
	$skyscapper = document.getElementById('skyscraper_id').value;
	
	//alert($banner);
	//alert($skyscapper);
	//alert($title);
	//$company = document.getElementById('company').value;
	//alert($company);
	$description = document.getElementById('description').value
	//alert($description);
	$clickthroughurl = document.getElementById('clickthroughurl').value
	//alert($clickthroughurl); 
	///alert(Date.parse($startdate));
	//alert(Date.parse($enddate));
	if (Date.parse($startdate) > Date.parse($enddate)) {
		alert("Invalid Date Range!\nStart Date cannot be after End Date!")
		return false;
	}
	
	if (Date.parse($enddate) < Date.parse($startdate)) {
		alert("Invalid Date Range!\nEnd Date cannot be before Start Date!")
		return false;
	}


	
	
	var incomplete = '0';
	//alert($startdate);
		//alert($enddate);
	if($startdate == ''){
		incomplete = '1';
		alert("please set a start date for the campaign");
		//document.forms.campaign.startdate.style.backgroundColor="#ff0000";
	}
	if($enddate == ''){
		incomplete = '1';
		alert("please set an start date for the campaign");
		//document.forms.campaign.enddate.style.backgroundColor="#ff0000";
	}
	
	
	
	if($title == ""){
		incomplete = '1';
		//alert("no title");
		document.forms.campaign.title.style.backgroundColor="#ff0000";
	} 
	
	if($description == ""){
		incomplete = '1';
	//	alert("no caomoany");
		document.forms.campaign.description.style.backgroundColor="#ff0000";
	}

	// poll question 
	if($clickthroughurl == ""){ // dosnt allow default link string
		incomplete = '1';
		document.forms.campaign.clickthroughurl.style.backgroundColor="#ff0000"
	}
		
		//var i = 0;
		///alert($shownum);
		//
		/*for(var i = 1;i<$shownum+1;i+=1){
			
			//alert(i);

		guestname = document.getElementById('guestname'+i).value;
		guesttitle = document.getElementById('guesttitle'+i).value;
		companytitle= document.getElementById('companytitle'+i).value;
		showtopic = document.getElementById('showtopic'+i).value;
		
		//alert(guestname);
		
		if(guestname =="guest name"){
			incomplete = '1';
			div = document.getElementById('guestname'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(guesttitle =="guest title"){
			incomplete = '1';
			div = document.getElementById('guesttitle'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(companytitle =="company name"){
			incomplete = '1';
			div = document.getElementById('companytitle'+i);
			div.style.backgroundColor="#ff0000";
		}
		
		if(showtopic =="topic"){
			incomplete = '1';
			div = document.getElementById('showtopic'+i);
			div.style.backgroundColor="#ff0000";
		}
		
	}*/
	
	//alert("made it so far");
	if(incomplete == '0'){
	if($banner == '0'){
		
		alert("you have not chosen a banner for this campaign. You will not be able to use this campain for the banner in an alert or newsletter before you do so.")
		
	}
	
	if($skyscapper == '0'){
		
		alert("you have not chosen a skyscraper for this campaign. You will not be able to use this campain for a skyscaper in an alert or newsletter before you do so.")
		
	}
		document.forms.campaign.submit();
	}

	
	
	
	// make sure there is at least 2 answers
	
}

function removeAnswer(id){
	//alert(id);
	var ni = document.getElementById('alertli'+id);
	var d = document.getElementById('showlist');
 
  d.removeChild(ni);
  if(id < 20000){
  
  	createRequest(); //representing if results are return as a percentage
  	
	var url = "removeAnswers.php";
	request.open("POST", url, true);
	request.onreadystatechange = alertRemoves;
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send("aid=" + id);

  }

	
}

function alertRemoves(){
	//alert(request.responseText);
}

function collectImages(){
	
	
	
}


function setResponse(){
	//alert('set res');
	 var answerID = getSelectedItem();
	 if (answerID != 'nochoice') {
	 	//alert('set res '+answerID);
	 	var percentage = getPercentage(); // find the hidden div that contains the 1 or 0
	 	var id = getId(); // find the hidden div that contains the id of the poll
	  						//so it knows what results to ask for 
			createRequest(); //representing if results are return as a percentage
			var url = "getPollsResponses.php";
			request.open("POST", url, true);
			request.onreadystatechange = updatePage;
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send("id=" + id  + "&result=" + answerID + "&percentage=" + percentage);
		}
}

function getResponses() {
	alert('getres called');
	var percentage = getPercentage(); // find the hidden div that contains the 1 or 0 
	  									//representing if results are returned as a percentage
	var id = getId(); // find the hidden div that contains the id of the poll
	  									//so it knows what results to ask for
    createRequest();
	 var url = "getPollsResponses.php";
     request.open("POST", url, true);
     request.onreadystatechange = updatePage;
	 request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     request.send("id="+id+"&percentage="+percentage+"&barcol=#000000");
	 
	 
	

  }
  
  function testCookie(css){
 //alert('test cookie');
		deleteCookie('poll');
	var headID = document.getElementsByTagName("head")[0];         
	var cssNode = document.createElement('link');
	cssNode.type = 'text/css';
	cssNode.rel = 'stylesheet';
	cssNode.href = css;
	cssNode.media = 'screen';
	headID.appendChild(cssNode);
	 var mydiv = document.getElementById("poll");
		  mydiv.style.visibility = 'visible'; 
	if(readCookie('poll')){
		//alert('c exits');
	 	getResponses()
		 var newTotal = request.responseText;
		var mydiv = document.getElementById("poll");
		  mydiv.style.visibility = 'hidden'; 
		  var mydiv = document.getElementById("results");
		  mydiv.style.visibility = 'visible'; 
		  mydiv.innerHTML = newTotal;
		
	 }else{
	 	
	 	// alert('c not exits');
	 	// setResponse();
	 	// createCookie('poll','1','20');
	 }
	
  }
  
  function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
	
	}

	function deleteCookie(name) {
		//alert(name);
		//document.cookie = name +'=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
		createCookie(name,"",-1);

		//alert(name);

	} 

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

	function getPercentage(){
		
		 var mydiv = document.getElementById("percentage");
		 var p = mydiv.firstChild.nodeValue;
		 return p;
	}
  function getId(){
		
		 var mydiv = document.getElementById("id");
		 var i = mydiv.firstChild.nodeValue;
		 return i;
	}
  
  function getSelectedItem() {
		
		chosen = "";
		len = document.pollform.answer.length;
			
		for (i = 0; i <len; i++) {
			if (document.pollform.answer[i].checked) {
			chosen = document.pollform.answer[i].value;
			}
		}
		
		if (chosen == "") {
			
			return 'nochoice';
			
		//alert("No Location Chosen");
		}
		else {
			
		return chosen;
		
		}
		
		}
		
		function preview(id){
			
		    createRequest();
			percentage = '1';
			 var url = "getPollsResponses.php";
		     request.open("POST", url, true);
		     request.onreadystatechange = updatePagePreview;
			 request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		     request.send("id="+id+"&percentage="+percentage);
		}
		
		function updatePagePreview(){
			var newTotal = request.responseText;
			//alert(newTotal);
			var mydiv = document.getElementById("results_preview");
			mydiv.style.visibility = 'visible';
			mydiv.innerHTML = newTotal;
		}

  function updatePage() {
	//alert('res');
    if (request.readyState == 4) {
		if (request.status == 200) {
			var newTotal = request.responseText;
			var mydiv = document.getElementById("poll_answers");
			mydiv.style.visibility = 'hidden';
			var mydiv = document.getElementById("results");
			mydiv.style.visibility = 'visible';
			mydiv.innerHTML = newTotal;
			var mydiv = document.getElementById("formButton");
			mydiv.style.visibility = 'hidden';
			
			
		} else {
			var mydiv = document.getElementById("poll_error");
			mydiv.style.visibility = 'visible';
		}
    }
  }
  
  function dump(arr,level) {
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
}
