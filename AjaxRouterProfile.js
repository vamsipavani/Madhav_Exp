function createRequestObject()
{
	var ro;
  var browser = navigator.appName;

  if(browser == "Microsoft Internet Explorer") {
		// on IE, we have to use ActiveX
  	ro = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
  	// on every other browser, we can directly create a new XMLHttpRequest object
    ro = new XMLHttpRequest();
  }
  return ro;
}

var http = createRequestObject();

function showUserCategories(userAction, context)
{
  alert(userAction);
  alert(context);
  http.open("get", "expLegend.php?action="+userAction+"&context="+context);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function handleResponse()
{
     if(http.readyState == 4)
      {

        document.getElementById("profileArea").innerHTML=http.responseText;
    }
     else
     {

       document.getElementById("profileArea").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }
}
