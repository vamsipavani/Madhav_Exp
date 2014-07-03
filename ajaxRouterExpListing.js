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

function showExpListing(ordVar)
{
  Alert(ordVar);
  http.open("get", "expListing.php?ordClause="+ordVar);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function changeBillCycle(form)
{
  //var mth = form.getElementById("billMonth").value;
  //var yr  = form.getElementById("billYear").value;
  
  var mth = document.expListing.billMonth.value;
  var yr  = document.expListing.billYear.value;
  
  //var mth = form.billMonth.value;
  //var yr  = form.billYear.value;
  

  http.open("get", "expListingData.php?billingMonth=" + mth + "&billingYear=" + yr +"&dateChanged=y");
  http.onreadystatechange = handleOrdResponse;
  http.send(null);  
}

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

function setNeedToUpdateFlag(myIndex)
{

  var windowForm = document.expListing;
  var checkbox     = eval("windowForm.expChanged"+myIndex);
  checkbox.checked     = true;
    //return true;
}

function orderByMer()
{

  var mth = document.expListing.billMonth.value;
  var yr  = document.expListing.billYear.value;
  
  http.open("get", "expListingData.php?ordClause=m&billingMonth=" + mth + "&billingYear=" + yr +"&dateChanged=y");
  http.onreadystatechange = handleOrdResponse;
  http.send(null);
}

function orderByAmt()
{

  var mth = document.expListing.billMonth.value;
  var yr  = document.expListing.billYear.value;

  http.open("get", "expListingData.php?ordClause=a&billingMonth=" + mth + "&billingYear=" + yr +"&dateChanged=y");
  http.onreadystatechange = handleOrdResponse;
  http.send(null);
}

function saveNewExpenses()
{
   var windowForm = document.expAddExpenses;
   windowForm.submit();
}  


function handleOrdResponse()
{
     if(http.readyState == 4)
     {
		document.getElementById("expListingDataArea").innerHTML=http.responseText;
     } 
     else
     {

       document.getElementById("expListingDataArea").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }
}

function saveListingChanges()
{
   var windowForm = document.expListing;
   windowForm.submit();
}

