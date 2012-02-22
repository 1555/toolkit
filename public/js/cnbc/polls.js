/**
 * @author 127003597 aka Edward Hunton (opps)
 */

function inishCreator(){
	var numi = document.getElementById('theValue');
	numi.setAttribute('value','0');
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

function addAnswer(mynum){
	alert("add called");
	 var ni = document.getElementById('fieldset-answers');
	 alert(ni);
	var num = 0;
	var numi = document.getElementById('theValue');
	var num = (document.getElementById('theValue').value -1)+ 2;
	alert(num);
	//if(numi.value != '20000'){
		numi.value = num;
	//} 
	var newdiv = document.createElement('li');
	if(mynum == 0){num+=20000;}
  	var divClassName = 'pollli'+num;
  	newdiv.setAttribute('id',divClassName);
	newdiv.innerHTML = '<input type="text" name="pollanswer'+num+'" size="100"><input type="button" value="-" onClick="removeAnswer('+num+')"></li>';

  	ni.appendChild(newdiv);

	var divtorecieve = document.getElementById('answerslist');

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
	
	// look at pollname
	$nameval = document.forms.createpoll.pollname.value;
	$polldesc = document.forms.createpoll.polldescription.value;
	$pollq = document.forms.createpoll.pollquestion.value;
	var incomplete = '0';
	//alert(incomplete);
	// poll title
	if($nameval == ""){
		incomplete = '1';
		//alert("no name");
		document.forms.createpoll.pollname.style.backgroundColor="#ff0000"
	}
	//alert(incomplete);
		// poll description
	if($polldesc == ""){
		incomplete = '1';
		document.forms.createpoll.polldescription.style.backgroundColor="#ff0000"
	}

	// poll question 
	if($pollq == ""){
		incomplete = '1';
		document.forms.createpoll.pollquestion.style.backgroundColor="#ff0000"
	}
	
	if(incomplete == '0'){
	
		document.forms.createpoll.submit();
	}

	
	
	
	// make sure there is at least 2 answers
	
}

function removeAnswer(id){
	alert(id);
	var ni = document.getElementById('answers-answer'+id);
	alert(ni)
	var d = document.getElementById('fieldset-answers');
 
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
	alert('res');
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
