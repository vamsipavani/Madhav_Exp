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

function sndChartType()
{
  http.open("get", "expHeader_test.php?chartStyle=BAR");
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelinePrev()
{
  http.open("get", "expHeader_test.php?timeLine=prevMth");
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelineNext()
{
  http.open("get", "expHeader_test.php?timeLine=nextMth");
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelineYTD()
{
  http.open("get", "expHeader_test.php?timeLine=ytd");
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
        
        document.getElementById("chartArea").innerHTML=http.responseText;
    }
}
