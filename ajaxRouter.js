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
  http.open("get", "expHeader_test.php?chartStyle=BAR&action=" + action);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function sndChartType(group,style)
{
  http.open("get", "expHeader_test.php?chartStyle=" + style + "&action=" + group);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelinePrev(group,style,currCycleId,tline)
{
  var cycleToUse =parseInt( document.expGraphShell.cycleIdToUse.value,10) - parseInt(1,10);
  
  http.open("get", "expHeader_test.php?chartStyle=" + style + "&action=" + group+"&timeLine="+tline+"&cycleIdToUse="+cycleToUse);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelineNext(group,style,currCycleId,tline)
{
  var cycleToUse =parseInt( document.expGraphShell.cycleIdToUse.value,10) + parseInt(1,10);
  
  http.open("get", "expHeader_test.php?chartStyle=" + style + "&action=" + group+"&timeLine="+tline+"&cycleIdToUse="+cycleToUse);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeTimelinePrevThree(group,style,currCycleId,tline)
{
  
  http.open("get", "expHeader_test.php?chartStyle=" + style + "&action=" + group+"&timeLine="+tline+"&cycleIdToUse="+currCycleId);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function showExpDetails(expType,currCycleId)
{
  http.open("get", "expDetails.php?type="+ expType+"&cycleIdToUse="+currCycleId);
  http.onreadystatechange = handleDetailsResponse;
  http.send(null);
}

function showExpListing(ordVar)
{
  http.open("get", "expListing.php?ordClause="+ordVar);
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
        
        document.getElementById("someText").innerHTML=http.responseText;
    }
     else
     {
            
       document.getElementById("someText").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }
}

function handleDetailsResponse()
{
     if(http.readyState == 4) 
     {
        
        document.getElementById("expDetailsArea").innerHTML=http.responseText;
     }
     else
     {
            
       document.getElementById("expDetailsArea").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }     
}

function setNeedToUpdateFlag(myIndex)
{

  window.alert(myIndex);
  var windowForm = document.expListing;
  var checkbox     = eval("windowForm.expChanged"+myIndex);
  checkbox.checked     = true;
    //return true;
}

function saveListingChanges()
{
  http.open("POST", "expSaveUpdates.php?action=submit");
  http.onreadystatechange = handleResponse;
  http.send(null);
}
function orderByMer(ordMer)
{
  http.open("get", "expListing_test.php?ordClause="+ordMer);
  http.onreadystatechange = handleOrdResponse;
  http.send(null);
}

function orderByAmt(ordAmt)
{
  http.open("get", "expListing_test.php?ordClause="+ordAmt);
  http.onreadystatechange = handleOrdResponse;
  http.send(null);
}

function handleOrdResponse()
{
     if(http.readyState == 4) 
     {
        
        document.getElementById("expListingArea").innerHTML=http.responseText;
     }
     else
     {
            
       document.getElementById("expListingArea").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }     
}