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

// this function should be called for user input
// it opens up a php page with a querystring of 'action'
// this function could probably be adapted to POST
function sndReq(action)
{
  http.open("get", "ajax.php?action=" + action);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

// the response in this case is formatted as follows:
// object|text
// where object is the id of the HTML element we are going to update
// and text is what it will be updated to
// this could obviously work a lot better with some XML
function handleResponse()
{
    if(http.readyState == 4) 
    {
      var response = http.responseText;
      var update = new Array();
      
      if(response.indexOf('|' != -1)) 
      {
        update = response.split("|");
        document.getElementById(update[0]).innerHTML = update[1];
      }
    }
}