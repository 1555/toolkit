$(document).ready(function(){



var cnbc_europe_universalparks = {
	
	// get parent div
	
	"init": function(parentDivName){
		console.log('called');
		// find the parent div that will hold the form
		var parentDiv = cnbc_europe_universalparks.grabParentDiv(parentDivName);
		cnbc_europe_universalparks.createForm(parentDiv);
	var options = {
        beforeSubmit: function() {
            return $('#europe_competition').validate().form();
        },
      target: '#detailsView',
	 // clearForm: 'true',
	 // resetForm: 'true'
    };


 
// pass options to ajaxForm 
$('#europe_competition').ajaxForm(options);
		
		
		
	},
	
	"grabParentDiv": function(parentDivName){
		
		var parentDiv = $("#europecompetition");
		return parentDiv;
		
	},
	
	"createForm":function(parent){
		var inputs = new Array({'input':'text','label':'First Name', 'id':'firstname', 'class':'required input_text', 'name':'firstname', 'maxLen':'50'},{'input':'text','label':'Surname','id':'surname','class':'required input_text','name':'surname', 'maxLen':'50'},{'input':'text','label':'Email Address','id':'emailaddress','class':'required email input_text','name':'emailaddress', 'maxLen':'200'},{'input':'text','label':'Telephone','id':'telephone','class':'required number input_text','name':'telephone', 'maxLen':'20'},{'input':'text','label':'Street Address','id':'streetaddress','class':'required input_text','name':'streetaddress', 'maxLen':'100'},{'input':'text','label':'City','id':'city','class':'required input_text','name':'city', 'maxLen':'50'},{'input':'text','label':'Postcode','id':'postcode','class':'required input_text','name':'postcode', 'maxLen':'8'},{'input':'submit','label':'Submit','id':'submit','name':'submitform', 'maxLen':''})
		form = document.createElement('form');
		form.id
		ul = document.createElement('ul');
	form.action = "http://toolkit.cnbceuropeshared.com/public/forms/universalparkscompetition_proxy.php";
		//form.action = "/toolkit/public/index.php/admin/index/registeruser";
		//form.action = "http://toolkit.cnbceuropeshared.com/public/admin/index/registeruser";
		
		form.method = "POST";
		form.setAttribute("id","europe_competition");
		for (var x = 0;x< inputs.length; x++){
			
			li = document.createElement('li');
			formElement = document.createElement('INPUT');
			formElement.setAttribute('class', inputs[x].class);
			formElement.type = inputs[x].input;
			formElement.maxLengh = inputs[x].maxLen;
			formElement.id = inputs[x].id;
			formElement.name = inputs[x].name;
			var newlabel = document.createElement("Label");
			var newSpan = document.createElement("Span");
    		newlabel.setAttribute("for",inputs[x].id);
			newlabel.setAttribute("class",'lab');
   			newlabel.innerHTML = inputs[x].label;
			newSpan.appendChild(formElement);
			li.appendChild(newlabel);
			li.appendChild(newSpan);
			
			
			ul.appendChild(li);
			
		}
		
		form.appendChild(ul);
		document.getElementById('europecompetition').appendChild(form);
		
		
	},
	
	
	
};


cnbc_europe_universalparks.init('europecompetition');
	
});