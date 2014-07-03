var formID  = "expUserCategories";    // The ID of the contact form element
var form    = document.getElementById(formID);

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

function UpdateUserCat(rowId,rowCat, userAction,usrQuery,newRows)
{

  http.open("get", "expRenderTabData.php?action="+userAction+"&rowId="+rowId+"&rowCat="+rowCat+"&query="+usrQuery+"&moreRows="+newRows);
  http.onreadystatechange = handleResponse;
  http.send(null);
}

function addMoreRows(userQuery)
{
  //alert("need more rows");
  http.open("get", "expRenderTabData.php?moreRows=yes&query="+userQuery+"&time="+Date());
  http.onreadystatechange = handleResponse;
  http.send(null);
}


function createQuery(form,usrQuery)
{
    var elements = form.elements;
    var pairs = new Array();

    for (var i = 0; i < elements.length; i++) 
    {
    
        if ((name = elements[i].name) && (value = elements[i].value))
        {
           //window.alert(name);
           //window.alert(value);
           
           pairs.push(name + "=" + encodeURIComponent(value));
            
        }    
    }
    pairs.push("ajax=1");
    pairs.push("postData=1");
    pairs.push("query="+usrQuery);
    return pairs.join("&");
}


function postCatData(userQuery)
{
    var status = false;
    
    var windowForm  = document.expUserCategories;
    var checkPost   = eval("windowForm.postData");
    checkPost.value = "yes";

    var query = createQuery(document.getElementById("expUserCategories"),userQuery);
    var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

    http.open("post", "expRenderTabData.php", true);
    http.setRequestHeader("Content-Type", contentType);
    http.onreadystatechange = handleResponse;    
    http.send(query);
}

function handleResponse()
{
     if(http.readyState == 4)
      {

        document.getElementById("expUserProfile").innerHTML=http.responseText;
     }
     else
     {

       document.getElementById("expUserProfile").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }
}
