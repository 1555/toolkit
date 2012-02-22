function replaceText(el, text) {
  if (el != null) {
    clearText(el);
    var newNode = document.createTextNode(text);
    el.appendChild(newNode);
  }
}

function checkchars(txtObj){
		//Define array of disallowed characters
		//alert("checkcars called");
		var restricted_chars=new Array();
		restricted_chars['*']=1;
		restricted_chars['(']=1;
		restricted_chars[')']=1;
		restricted_chars['#']=1;
		restricted_chars['=']=1;
		restricted_chars['%']=1;
		restricted_chars['&']=1;
		restricted_chars['+']=1;
		restricted_chars['"']=1;
		restricted_chars['}']=1;
		restricted_chars['{']=1;
		restricted_chars['@']=1;
		restricted_chars['>']=1;
		restricted_chars['<']=1;
		restricted_chars['^']=1;
		//get the last character typed
		var mychar=txtObj.value.charAt(txtObj.value.length-1);
		
		//check if character is in disallowed array if so, Send Alert and delete character
		if(restricted_chars[mychar]){
		alert("Character not allowed");
		txtObj.value=txtObj.value.substr(0,txtObj.value.length-1);
		}

}


function limitText(limitField, limitCount, limitNum) {
	//alert("called");
	checkchars(limitField)
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}


function clearText(el) {
  if (el != null) {
    if (el.childNodes) {
      for (var i = 0; i < el.childNodes.length; i++) {
        var childNode = el.childNodes[i];
        el.removeChild(childNode);
      }
    }
  }
}

function getText(el) {
  var text = "";
  if (el != null) {
    if (el.childNodes) {
      for (var i = 0; i < el.childNodes.length; i++) {
        var childNode = el.childNodes[i];
        if (childNode.nodeValue != null) {
          text = text + childNode.nodeValue;
        }
      }
    }
  }
  return text;
}