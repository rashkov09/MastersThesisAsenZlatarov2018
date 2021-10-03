
function GetXmlHttpObject(pageElement)   {
    if (pageElement.indexOf("bell") == -1) {
	if (pageElement.indexOf("opener.") != -1) {
	    pageElement=pageElement.substr(7); 
	    opener.document.getElementById(pageElement).innerHTML = '<img src="../img/loading.gif" /> ...';
	}
	else 	document.getElementById(pageElement).innerHTML = '<img src="../img/loading.gif" /> ...';
    }
    var xmlHttp=null;
    
    try     {
         xmlHttp=new XMLHttpRequest();
     }
    catch (e) {
        console.log(e.message);
         try         {
              xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
          }
         catch (e)   {
              xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
     }
    return xmlHttp;
}

function users(url, pageElement){ 
    var xmlHttp=GetXmlHttpObject(pageElement);
    if (xmlHttp==null)    {
         alert ("Browser does not support HTTP Request");
         return ;
    }
    xmlHttp.onreadystatechange = function() {responseAHAH(pageElement,xmlHttp);	};
    url+="&sid="+Math.random();
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}


function responseAHAH(pageElement,xmlHttp) {
    if (xmlHttp.readyState==4) {
	if (xmlHttp.status==200) {
	    if (pageElement.indexOf("opener.") != -1) {
		pageElement=pageElement.substr(7);
		opener.document.getElementById(pageElement).innerHTML =xmlHttp.responseText;
	    } else {
        	document.getElementById(pageElement).innerHTML=xmlHttp.responseText;
            }
        }
    }
}


///////////////////////////////

var http_request = false;

/**************************************************************************************************/
function makePOSTRequest(url, parameters) {
      document.getElementById('details').innerHTML = '<img src="../img/loading.gif" /> ...';
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = alertContents;
      http_request.open('POST', url, true);
      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http_request.setRequestHeader("Content-length", parameters.length);
      http_request.setRequestHeader("Connection", "close");
      http_request.send(parameters);
}
/**************************************************************************************************/
function makePOSTRequestNoResponse(url, parameters) {
    console.log('sending: ' + parameters + ' TO: ' + url);
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = function()
      {
          console.log('NO resp'); 
      };
      http_request.open('POST', url, true);
      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      http_request.setRequestHeader("Content-length", parameters.length);
      http_request.setRequestHeader("Connection", "close");
      http_request.send(parameters);
      console.log('should have posted');
}
/**************************************************************************************************/
function alertContents() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            result = http_request.responseText;
            document.getElementById('details').innerHTML = result;
         }
      }
}
/**************************************************************************************************/
var targetElementId ='';
function makePOSTRequestFor(url, parameters, targetelement) {
      targetElementId = targetelement;
      document.getElementById(targetelement).innerHTML = '<img src="../img/loading.gif" /> ...';
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = alertContentsTo;
      http_request.open('POST', url, true);
      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//      http_request.setRequestHeader("Content-length", parameters.length);
//      http_request.setRequestHeader("Connection", "close");
      http_request.send(parameters);
}
/**************************************************************************************************/
   function alertContentsTo() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            result = http_request.responseText;
            document.getElementById(targetElementId).innerHTML = result;
         } else {
             
         }
      }
   }
/**************************************************************************************************/
function respondTo(url, responsehandler)  {
    http_request=new XMLHttpRequest();//GetXmlHttpObject(pageElement);
    if (http_request==null) {
         alert ("Browser does not support HTTP Request");
         return;
    }
    http_request.onreadystatechange = responsehandler;
    url+="&sid="+Math.random();
    http_request.open("GET",url,true);
    http_request.send(null);
}
/**************************************************************************************************/
function getFarValue(url,relement){
    if (typeof relement === 'string' || relement instanceof String)
    {
	relement = document.getElementById(relement);
    }
    http_request=new XMLHttpRequest();//GetXmlHttpObject(pageElement);
    if (http_request==null)    {
         alert ("Browser does not support HTTP Request");
         return;
    }
    http_request.onreadystatechange = function(){
        relement.value=http_request.responseText;
    };
    url+="&sid="+Math.random();
    http_request.open("GET",url,true);
    http_request.send(null);
}
/**************************************************************************************************/
function gatherFormValues(formId){
    var elem   = document.getElementById(formId).elements;
    var params = "";
    for (var i = 0; i < elem.length; i++) {
        if (elem[i].tagName == "select") {
            value = elem[i].options[elem[i].selectedIndex].value;
        } else 
        if ( (elem[i].tagName == "checkbox") || (elem[i].type == "checkbox") ) {
            if (!elem[i].checked){ continue; }
            value = 1;
        } else 
	{
	    if (elem[i].value==''){ continue; }
            value = elem[i].value;
        }
        params += elem[i].name + "=" + encodeURIComponent(value) + "&";
    }
    return params;
}
/**************************************************************************************************/
function postFormValues(formId, container, url){
    var params = gatherFormValues(formId);
    makePOSTRequestFor(url, params, container);
}
/**************************************************************************************************/