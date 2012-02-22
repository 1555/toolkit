// JavaScript Document

var portfolio = {
		
		
"timer_is_on": 0,
"t": 0,

"syms": [],
"allSyms":[],
"symbolParams":'',
"storyParams":'',

"swapIframe": function(page){
	
	frames['wsodchart'].location.replace(page); 
	
},
  
"init":function(){
	console.log('init');
	// get all of the symbols already stored in the cookie
	
	// the cookie values i.e. .FTSE
	 portfolio.syms = portfolio.getSymbolsFromCookie();
	 // the cookie items i.e. stock2091874=.FTSE
	 portfolio.allSyms = portfolio.getAllStockCookies();
	 portfolio.swapIframe('http://toolkit-stage.cnbceuropeshared.com/public/myportfoliowelcome.html');
	 portfolio.firstCheck();
	
 
 },
 
 "firstCheck":function(){
	 console.log('firstCheck');
	 // if there are any symbols...
	 if(portfolio.syms.length > 0){
		 portfolio.symbolsParams = portfolio.buildString(portfolio.syms, '|'); // different services expect symbols in different formats
		 portfolio.storyParams = portfolio.buildString(portfolio.syms, ';'); // different services expect symbols in different formats
		 portfolio.requestAll();
	 }else {
		 
			portfolio.setMessages();
			portfolio.refreshBox('none');
	 }
 
 },
 
 "requestAll":function(){
	 console.log('requestAll');
	// attach the grab action to the click event of a set of buttons
	 
	portfolio.grab('blogs','portfolio.getBlogsCallback',portfolio.storyParams);
	 portfolio.grab('stocks','portfolio.getStocksCallback', portfolio.symbolsParams);
	 portfolio.grab('stories','portfolio.getStoriesCallback', portfolio.storyParams);
	 portfolio.grab('videos','portfolio.getVideosCallback',portfolio.storyParams);
 	// sets the display style of the  'refresh box' - this is a dic that displays a loading message whilst the calls are going on
 	portfolio.refreshBox('inline');
 	// starts the timer going - this is used to time update calls for the data
   portfolio.doTimer();
 	// swaps out existing chart i-frame for a page with a message on it
 },
 
 "setMessages":function(){
	 console.log('setMessages');
	// if there are no symbols locate the last row in the stories table	and add the message
		var row = portfolio.getRow('stories_table','last');
		var x = row.insertCell(-1);
		var td = "<ul class='ll_bullet' ><p style='color:#2D648A;font-family:Arial, Helvetica, sans-serif;font-weight:bold;margin-left:5px;margin-top:0px;font-size:10px;margin:0px;padding-left:10px;'>Add stock symbols above to get related news stories</span></ul>";
		x.innerHTML = td;
		
	    // if there are no symbols locate the last row in the blogs table and add the message
		var row = portfolio.getRow('blogs_table','last');
		var x=row.insertCell(-1);
		var td = "<ul class='ll_bullet' ><p style='color:#2D648A;font-family:Arial, Helvetica, sans-serif;font-weight:bold;margin-left:5px;margin-top:0px;font-size:10px;margin:0px;padding-left:10px;'>Add stock symbols above to get related blog posts</span></ul>";
		x.innerHTML = td;
		
		var row = portfolio.getRow('videos_table','last');
		var x=row.insertCell(-1);
		var td = "<ul class='ll_bullet' ><p style='color:#2D648A;font-family:Arial, Helvetica, sans-serif;font-weight:bold;margin-left:5px;margin-top:0px;font-size:10px;margin:0px;padding-left:10px;'>Add stock symbols above to get related videos</span></ul>";
		x.innerHTML = td;
		
		// when messages are in place turn refresh box back on
 },

 
// swicthes display style on div 
"refreshBox": function(vis){
	 console.log('refreshBox');
	 document.getElementById('story_refresh').style.display = vis;
	 document.getElementById('video_refresh').style.display = vis;
	 document.getElementById('blogs_refresh').style.display = vis;
	
 },
 


 
"prefsToggle": function(){ // swapped for refresh function
	 console.log('prefsToggle');
	 // if the syms are already collected don't get them again
	 if(portfolio.syms == []){
		 portfolio.syms = portfolio.getSymbolsFromCookie();
	 }
	if(portfolio.syms.length > 0){
		
	}else{
		portfolio.refreshBox('none');
	}
	 
	portfolio.flush('stories_table');
	portfolio.flush('videos_table');
	portfolio.flush('blogs_table');
	
//ortfolio.init();

	
	
	if(portfolio.syms.length > 0){ 
		portfolio.refreshBox('inline');
		if(portfolio.storyParams == ''){
			portfolio.storyParams = portfolio.buildString(portfolio.syms, ';'); // different services expect symbols in different formats
		}

		portfolio.grab('stories','portfolio.getStoriesCallback', portfolio.storyParams);
		portfolio.grab('videos','portfolio.getVideosCallback',portfolio.storyParams);
		portfolio.grab('blogs','portfolio.getBlogsCallback',portfolio.storyParams);
		portfolio.swapIframe('http://toolkit-stage.cnbceuropeshared.com/public/myportfolioholder.html');
		
 } else {
	    portfolio.swapIframe('http://toolkit-stage.cnbceuropeshared.com/public/myportfoliowelcome.html'); 
	    portfolio.setMessages();
 
 }

}, 
// removes all the stories etc from the tables in the 'mybuzz' box
"flush": function(table){
	 console.log('flush');
	var tbl = document.getElementById(table);

	 var lastRow = tbl.rows.length;
	 for(var i = (lastRow-1);i>=0;i--){
	
		 document.getElementById(table).deleteRow(i);
	}
	
},
 
 
"grab": function(type, callBack, syms){
	 console.log('grab');
            $.ajax({
                url: 'http://toolkit-stage.cnbceuropeshared.com/public/portfolio.php',
                data: {syms: syms, type: type},
                dataType: 'jsonp',
                jsonp: 'callback',
                jsonpCallback: callBack, 
               success: function(){
                  
                },
    
    error: function(){
                 
                }
            });
  },
  

   
"allCharts": function(sym){
	 console.log('allCharts');
	  sym = portfolio.stripGB(sym);
	   frames['wsodchart'].location.replace('http://apps.cnbc.com/company/quote/incchart.asp?symbol='+sym+'');
   },
   
"stripGB": function(sym){
	 console.log('stripGB');
	   if(sym.substr(5,7) == 'GB'){
	   var subst = sym.substr(0,5);
	   sym = subst+'LN';
	   }
	   return sym;
	   
   },
   
"removesec": function(sec, r, stockkey){
	 console.log('removesec');
		var i=r.rowIndex;
		portfolio.syms = [];
		portfolio.allSyms = [];
		portfolio.symbolParams = '';
		portfolio.storyParams = '';
		
		document.getElementById('portfolio_table').deleteRow(i);
		portfolio.createCookie(stockkey,"",-1);
		portfolio.prefsToggle(); // aka flush
	},

"createCookie": function(name,value,days) {
	 console.log('createCookie');
	var expires =  '';
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			expires = "; expires="+date.toGMTString();
		}else{
			expires = "";
		}
		document.cookie = name+"="+value+expires+"; path=/";
	},

"getRow": function(table, poss){
	 console.log('getRow');
	 var row;
	var tbl = document.getElementById(table);
			if(poss == 'last'){
			//alert(poss);
 			 var lastRow = tbl.rows.length;
  			row = tbl.insertRow(lastRow);
			 return row;
			} else {
				//alert(poss);
			row = tbl.rows[poss];
  			if(row == undefined){
  				row = tbl.insertRow(poss);
  			}
			  
			  return row;
			
			}
	
},

// pulls values from json and writes them into cells
"getTableCell": function(security, stockkey){
	 console.log('getTableCell');
	var arrow = '';
	if(security["change"] < 0){
    arrow = 'http://media.cnbc.com/i/CNBC/CNBC_Images/componentbacks/watchlist_down.gif';
   } else {
    arrow = 'http://media.cnbc.com/i/CNBC/CNBC_Images/componentbacks/watchlist_up.gif';
   }
   var realclass = '';
   var rt = security["realTime"];
   if(rt == 'false'){
	   realclass = 'cnbc_show_Delayed_data';
   }else if(rt == 'true'){
	    realclass = '';
   }
   
     var l = security['last'];
	 var lnum = Number(l);
	 var la= lnum.toFixed(2);
   	var last = String(la);
	
   	var c = security['change'];
   	var change = '';
	if(c !== 'UNCH'){
		 var cnum = Number(c);
		 var ch= cnum.toFixed(2);
		 change = String(ch);
	 } else {
		  change = c;
	 }
	 

	
	 var cp = security['change_pct'];
	 var cpnum = Number(cp);
	var cpc= cpnum.toFixed(2);
	var change_pct = String(cpc);
	
	var sy = security['symbol'];
	var sym = "'"+sy+"'";
	var func = "portfolio.filter("+sym+");";
	var tds = "<div id='idID1ED' class='h23 cnbc_wl_mrq_div bluefont cursor_pt ocomp'   style='width:248px;backgroundColor:#FFFFFF;'><div class='bluefont cFont cf11 h23 lh21 clr cursor_pt ocomp'><div align='left' style='width: 30%;' class='fL h23'><div class='"+realclass+" h23 uC cstrong padL10 lh21'><span id='sec'><a onclick='window.location='http://data.cnbc.com/quotes/"+security['symbol']+"' onmouseover='cnbcwsod_loadchart(&quot;http://api-cdn.cnbc.com/api/chart/chart.asp?&amp;type=thumbnail&amp;charttype=overview&amp;timeframe=1month&amp;realtime=0&amp;symbol="+security['symbol']+"&amp;showHeader=&amp;showSidebar=0&amp;hideExchange=0&amp;changeOverTime=0&amp;showExtendedHours=0&quot;,&quot;http://data.cnbc.com/quotes/"+security['symbol']+"/tab/2&quot;,&quot;ID0E4F&quot;,&quot;"+security['name']+"&quot;);'>"+security['symbol']+"</a></span></div></div><div align='left' style='width: 20%;' class='fl h23'><div class='fl h23 padR10 lh21 blac' onclick="+func+"><span id='last'>"+last+"</span></div></div><div align='center' style='width: 5%;' class='fL h23 lh8'><div style='padding-top: 5px;' onclick="+func+"><span id='WSODQ_.FTSE_CHANGEARROW_1_ID0E4F19751224'><img border='0' src='"+arrow+"'></span></div></div><div align='left' style='width: 18%;' class='fl h23 blac'><div class='fl h23 padL10 lh21' onclick="+func+"><span id='change'>"+change+"</span></div></div><div align='left' class='fl h23 blac'><div class='fl h23 padL10 lh21' onclick="+func+"><span id='changepc'>"+change_pct+"</span></div></div><div align='right'><div class='h23 padL10 lh21' style='float:right;'><span id='remove' style='float:right;'><a onclick=portfolio.removesec('"+security['symbol']+"',this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode,'"+stockkey+"'); style='float:right;margin-right:4px;'><img src='http://toolkit-stage.cnbceuropeshared.com/public/images/delete.gif' style='float:right;'/></a></span></div></div>";
	
	return tds;
	 
 },
 
// the functioned called when you filter the my buzz section by a specified symbol
"filter": function(sym){
	 console.log('filter');
	portfolio.allCharts(sym);
	portfolio.flush('stories_table');
	portfolio.flush('videos_table');
	portfolio.flush('blogs_table');
	portfolio.grab('stories','portfolio.getStoriesCallback', sym);
	portfolio.grab('videos','portfolio.getVideosCallback',sym);
	portfolio.grab('blogs','portfolio.getBlogsCallback',sym);
	
 },
   
 
	
 // used to provide a random key for the inserted stock 
"randomXToY": function(minVal,maxVal,floatVal){
	 console.log('randowmXToY');
	  var randVal = minVal+(Math.random()*(maxVal-minVal));
	  return typeof floatVal=='undefined'?Math.round(randVal):randVal.toFixed(floatVal);
},
	
	
"getStocksCallback": function(data){
	 console.log('getStocksCallback');
	if(portfolio.allSyms == []){
		portfolio.allSyms = portfolio.getAllStockCookies(); // collect all the cookie for the stocks 
	}
 for(var i=0;i<allSyms.length;i++){
	 var security;
 	if(portfolio.allSyms.length == 1){
		security = data["QuickQuoteResult"]["QuickQuote"];
		}else{
		security = data["QuickQuoteResult"]["QuickQuote"][i];
		};
		 if(security["change"] == '0.00'){
			 security["change"] = 'UNCH';
		}
		
		var row = portfolio.getRow('portfolio_table', 'last');
		var stockkey = '';
			if(portfolio.allSyms == 'empty'){
				stockkey = 'stock'+lastRow;
				} else {
				
				 var sym = trim(portfolio.allSyms[i]);
				
				if(sym.substr(13,sym.length) == security["symbol"]){
				row.id = sym.substr(0,12);
				}
				stockkey = sym.substr(0,12);
				
   	}
   
 var tds = portfolio.getTableCell(security,stockkey);

var x=row.insertCell(-1);
  x.innerHTML = tds;
 }
 
  
  
  
 },
 
"getStocksCallbackNew": function(data){
	console.log('getStocksCallbackNew');
		// the service could not locate the security - it was miss-spelled
		if(data["QuickQuoteResult"]["QuickQuote"]["code"] == '1'){
			
			portfolio.setFieldValue('getmystock', 'input_sym', 'unable to locate');
		 
		 return 'false';
		 
		 }; 
 
 		var security = data["QuickQuoteResult"]["QuickQuote"];
		 if(security["change"] == '0.00'){security["change"] = 'UNCH';} // data display convention
 
		 var row = portfolio.getRow('portfolio_table', 'last');
		 var myRand = portfolio.randomXToY(2000000, 2100000);
		 var x=row.insertCell(-1);
		 var stockkey = "stock"+myRand; // apend random number to force uniqueness, also to provide a fixed length for string manipulation
		 var tds = portfolio.getTableCell(security,stockkey);
		 x.innerHTML=tds;
		 document.cookie = "stock"+myRand+"="+security['symbol']+"; expires=Thu, 2 Aug 2030 20:47:11 UTC; path=/";
		 portfolio.prefsToggle(); // aka flush/re-build

},

"getStocksCallbackUpdate": function(data){
	
	console.log('getStocksCallbackUpdate');
	if(portfolio.allSyms == []){
		portfolio.allSyms = portfolio.getAllStockCookies(); // collect all the cookie for the stocks 
	}
	var length = portfolio.allSyms.length; //data["QuickQuoteResult"]["QuickQuote"].length;
    var len = length; // + 1;
    for(var i=0;i<len;i++){
    	var security = '';
 	if(length == 1){
		security = data["QuickQuoteResult"]["QuickQuote"];
		}else{
		security = data["QuickQuoteResult"]["QuickQuote"][i];
		};
		 if(security["change"] == '0.00'){security["change"] = 'UNCH';}
			 
			 var row = portfolio.getRow('portfolio_table', i);
			 var stockkey = '';
			   if(portfolio.allSyms == 'empty'){
				
				stockkey = 'stock'+lastRow;
				
			   } else {
				 var sym = trim(portfolio.allSyms[i]);
				if(sym.substr(13,sym.length) == security["symbol"]){
				 row.id = sym.substr(0,12);
				
				 }
    			stockkey = sym.substr(0,12);
   	}
   var tds = portfolio.getTableCell(security,stockkey);
  var x = document.getElementById("portfolio_table").rows[i];
  x.innerHTML = tds;

 }
},
 



"getStoriesCallback":function(data){
	console.log('getStoriesCallback');
	 portfolio.callbackwork('stories', data);
 },
 "getBlogsCallback": function(data){
		console.log('getBlogsCallback');
		  portfolio.callbackwork('blogs', data);
	  },
	 

"callbackwork":function(type, data){
	console.log('callbackwork');
	data =  portfolio.removeOlderThan(data,'h','24');

	
	if(data["cnbc-global-sitesearch-response"]["data"]["site-asset"] == undefined || data["cnbc-global-sitesearch-response"]["data"]["site-asset"] == '') {	   
		   // if there are no stories
		   var row = portfolio.getRow(type+'_table','last');
		   var x=row.insertCell(-1);
		   var td = portfolio.getTDMessage(type);
		   x.innerHTML = td;
	}
	 
	portfolio.refreshBox('none');
	 var storyLen = 0; 
	 if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
		 
		storyLen = 4;
	 } else {
		storyLen = 6;
	 }
	 var slen = parseInt(data["cnbc-global-sitesearch-response"]["data"]["total"]);
	
	if(slen <  storyLen){
	
		storyLen = slen;
		
	}
	
		for(var i=0;i<storyLen;i++){
			var asset = '';
		 if(storyLen == 1){
		    asset = data["cnbc-global-sitesearch-response"]["data"]["site-asset"];
		
		
		}else{
			
			 asset  = data["cnbc-global-sitesearch-response"]["data"]["site-asset"][i];
		};
		  var itemAge = portfolio.getItemAge(asset['pubDate'],'unix');
		  
		  if(itemAge !== 'remove'){
		  
		var row = portfolio.getRow(type+'_table','last');
		var mySyms = portfolio.eliminateDuplicates(portfolio.getMySyms(asset['tickersymbol']));
		var title = asset['title'];
		var titleTrunk =  title.substring(0,30)+'... ';
		
		var x=row.insertCell(-1);
		var td = "<ul class='ll_bullet'><li class='featSecondary ll_bullet disptable cFont cf11 clr' style='margin-left:8px;'><a href='"+asset['link']+"' class='cf11 clr'>"+titleTrunk+"</a><span style='color:#666666;font-size:10;'>"+mySyms+" "+itemAge+"</span></li></ul>";
		x.innerHTML = td;
		   
		  }
   } 
},
 


	
  
"removeOlderThan": function(data, timeframetype, unitOf){
	console.log('removeOlderThan');
	  for(var i = 0; i < data["cnbc-global-sitesearch-response"]["data"]["site-asset"].length; i++){
		var pubtime = data["cnbc-global-sitesearch-response"]["data"]["site-asset"][i]["pubDate"];
		var pt = pubtime.substr(0,10);
		
		var	p = parseInt(pt);
		var d = new Date();
		var du=d.getTime();
		var dp = String(du);
		var dt = dp.substr(0,10);
		var time = dt - p; // to get the time since that moment
		if(time < 604800){ // one week
			
		} else{
			delete data["cnbc-global-sitesearch-response"]["data"]["site-asset"][i];
		}
		  
	  }
	  return data;
  },
 
	
"getVideosCallback": function(data){
	console.log('getVideosCallback');
		// shorter list for windows - styling issues
	var storyLen = 0;
		 if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
			 storyLen = 4;
	 } else {
		 	storyLen = 6;
	 }
		 portfolio.refreshBox('none');
		 if(data["rss"]["channel"]["item"] !== undefined){
		 for(var i=0;i<storyLen;i++){
			 console.log(data);
			 var asset = data["rss"]["channel"]["item"][i];
			 var itemAge = portfolio.getItemAge(asset['pubDate'], 'date');
			 var title = asset['title'];
			 var titleTrunk =  title.substring(0,20)+'... ';
			 var row = portfolio.getRow('videos_table','last');
			 var x=row.insertCell(-1);
			 var mynewSyms = portfolio.eliminateDuplicates(portfolio.getMySyms(asset['metadata:tickersymbol']));
			 var td = "<ul class='ll_bullet'><li class='featSecondary disptable ll_bullet cFont cf11 clr' style='margin-left:8px;'><a href='"+asset['link']+"' class='cf11 clr'>"+titleTrunk+"<img width='11' vspace='0' hspace='0' height='7' border='0' style='padding-left:3px;padding-right:3px;' src='http://media.cnbc.com/i/CNBC/CNBC_Images/flexi/assets/icon_video_blue.gif'></a><span style='color:#666666;font-size:10px;'> "+mynewSyms+" "+itemAge+"</span></li></ul>";

			x.innerHTML = td;
		 }
  
 }
 
		 portfolio.refreshBox('none');
		 if(data["rss"]["channel"]["item"] == undefined) {
   
		   // if there are no videos for a symbol
		   var row = portfolio.getRow('videos_table','last');
		   var x=row.insertCell(-1);
		   
		   var td = portfolio.getTDMessage('videos');
		   
		   x.innerHTML = td;
 
    }
		 
}, 

"getTDMessage": function(param){
	console.log('getTDMessage');
	var td = "<ul class='ll_bullet'><li class='featSecondary ll_bullet disptable cFont cf11 clr' style='margin-left:8px;'><span style='color:#666666;'>There are currently no recent "+param+" linked to your assets</span></li></ul>";
   return td;
 },
	
	
// inish the timer	
"timedCount":function(){
	console.log('timedCount');
	if(portfolio.syms == []){	
		portfolio.syms  = portfolio.getSymbolsFromCookie();
	}
		 if(portfolio.syms.length > 0){ 
			 if(portfolio.symbolsParams == ''){
				 portfolio.symbolsParams = portfolio.buildString(portfolio.syms, '|'); // different services expect symbols in different formats
			 }
		 portfolio.grab('stocks','portfolio.getStocksCallbackUpdate', portfolio.symbolsParams);
		 portfolio.t = setTimeout("portfolio.timedCount()",9000);
	
		 }
},

// creates the timer if one dosnt exist
"doTimer": function(){
	console.log('doTimer');	
	if (portfolio.timer_is_on == 0)
	  {
		portfolio.timer_is_on=1;
		portfolio.timedCount();
	  }
},	
	
	// takes the pubDate node and either returns hrs, mins etc or a date depending on the format of the param - video service returns a date whilst stories returns unix
"getItemAge":function(pubtime, type){
	console.log('getItemAge');	
	if(type == 'date') { // wed 3rd of August
 
		var pt = pubtime.substr(0,3);
		var date = pubtime.substr(5,6);
		
		var dateStr = pt+" "+date;
		
		
		return trim(dateStr);
		
	}
		
	if(type == 'unix'){ // second since 1970
		var pt = pubtime.substr(0,10);
		var p = parseInt(pt);
		var d = new Date();
		var du=d.getTime();
		var dp = String(du);
		var dt = dp.substr(0,10);
		var time = dt - p; // to get the time since that moment
		var tokens = new Array ();
	
        tokens[31536000] = 'year';
        tokens[2592000] = 'month';
        tokens[604800] = 'week';
        tokens[86400] = 'day';
        tokens[3600] = 'hr';
        tokens[60] = 'min';
        tokens[1] = 'sec';
        var lasttime = 0;
	for(var token in tokens){
		if(time < token){
			
			lasttime = token;
			
		}else{
	
			 var numberOfUnits = Math.floor(lasttime / time);
			var timestr = numberOfUnits+' '+tokens[token];
			return timestr;
	
		} 
}
}
},


// extract the matches between our syms and the syms associated with a story, blog or video - takes all an assets syms as a param
"getMySyms": function(syms){
	console.log('getMySyms');
		var sysmstring = String(syms);
		var symarray =  sysmstring.split(',');
		
		if(symarray.length == 0){symarray = trim(sysmstring);}; 
		if(portfolio.allSyms == []){
			portfolio.allSyms = portfolio.getAllStockCookies();
		}
			var usedsyms = new Array();
			for(var i=0;i<portfolio.allSyms.length;i++){

              var sym = portfolio.allSyms[i];
			  var syma = sym.split('=');
			  var sym = syma[1];
			   
			   for(var n=0;n<symarray.length;n++){
					
				var snat = symarray[n];
				if(snat.toUpperCase() == sym){
					usedsyms.push(snat.toUpperCase());
				}
			}
		}
		return usedsyms;
},

// removes duplicate entries from array
"eliminateDuplicates":function(arr) {
	console.log('eliminateDuplicates');
  		var i,
    len=arr.length,
      out=[],
      obj={};

  for (i=0;i<len;i++) {
    obj[arr[i]]=0;
  }
  for (i in obj) {
	//  alert(i);
    out.push(i);
  }
  return out;
},



 
// extracts all my sumbols from the cookie - just returns the value
"getSymbolsFromCookie": function(){
	console.log('getSymbolsFromCookie');
 var allcookies = document.cookie.split(';');

 if(allcookies !== ''){
var allSyms = [];
// loop through all the cookies
 for(var i=0;i < allcookies.length;i++){
	 
  	 var sec = allcookies[i].split('=');
  	 // the values
	 var se = sec[1];
	 // the keys
	 var key = trim(sec[0]);

		if(se !== null){
			// make sure that the cookie is one of ours - they all start with 'stock'
			if(se.length < 10 && key.substr(0,5) == 'stock'){
				// if so add to the array
				allSyms.push(sec[1]);
			}
	}

}
 return allSyms;
 
 
 
 }
 
},

// get the cookies that are symbols - returns the key and the value
"getAllStockCookies": function(){
	console.log('getAllStockCookies');

		var allcookies = document.cookie.split(';');
		var allSyms = [];
		 for(var i=0; i<allcookies.length;i++){
		 var cString = trim(allcookies[i]);
		if(cString.substr(0,5) == 'stock'){
		   allSyms.push(cString);
		  }
 		 }
		return allSyms;
		
	},


// concatonates syms and correct delimiters for request string
"buildString": function(symArray, del){
	console.log('buildString');
	 var symstring = "";
	 for(var i = 0;i<symArray.length;i++){
	 
	  if(i < symArray.length-1){
	  symstring+=trim(symArray[i])+del;
	  }else {
	   symstring+=trim(symArray[i])+del;
	  }
	 }
	 return symstring;
},

// called from onclick of form button
"getsymtxt":function(){
	console.log('getsymtext');
 var sym = portfolio.getFieldValue('getmystock', 'input_sym');
 var allsyms = document.cookie.split(';');
 var double = portfolio.checkForDouble(sym, allsyms );
 var maxsyms = portfolio.checkForMax(allsyms, 4);
if(double == 'add' && maxsyms == 'add'){
	 portfolio.grab('stocks','portfolio.getStocksCallbackNew', sym);
} else {
	if(double == 'dontadd'){
		portfolio.setFieldValue('getmystock', 'input_sym', 'already watching');
	}
	if(maxsyms == 'dontadd'){
		portfolio.setFieldValue('getmystock', 'input_sym', 'max reached');
	}
}
 
 
},

"getFieldValue": function(form, field){
	console.log('getFieldValue');
	return trim(document.forms[form].elements[field].value);
},

"setFieldValue": function(form, field, value){
	console.log('setFieldValue');
	document.forms[form].elements[field].value = trim(value);
},

// check that a symbol is not already being used
"checkForDouble": function(symtocheck, allsyms){
	console.log('checkForDouble');
 symtocheck = symtocheck.toUpperCase();
 for(var i = 0; i < allsyms.length; i++){
  var symbol = allsyms[i];
  if(symbol.substr(14, symbol.length) == symtocheck){
	   document.forms['getmystock'].elements['input_sym'].value = 'duplicated asset';
   return 'dontadd';
  }
 }
 
 return 'add';
 
},

// lets us know if we should or should not add a stock to the list, put it in a cookie etc.
"checkForMax":function(syms, maxNum){
	console.log('checkForMax');
 var allSyms = [];
 for(var i=0; i<syms.length;i++){
 var cString = trim(syms[i]);
 if(cString.substr(0,5) == 'stock'){
   allSyms.push(cString);
  }
  
 }

 if(allSyms.length < maxNum){
  	return 'add';
 } else{
	
  	return 'dontadd';
 }
 
}
};
