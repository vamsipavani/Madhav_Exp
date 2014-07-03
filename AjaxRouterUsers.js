var formID  = "expUserData";    // The ID of the contact form element
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

function editUserData()
{

  http.open("get", "expRenderFormData.php?mode=edit&time="+Date());
  http.onreadystatechange = handleResponse;
  http.send(null);
}


function createQuery(form,frmMode)
{
    var elements = form.elements;
    var pairs = new Array();

    for (var i = 0; i < elements.length; i++) 
    {
    
        if ((name = elements[i].name) && (value = elements[i].value))
        {
           
           pairs.push(name + "=" + encodeURIComponent(value));
            
        }    
    }
    pairs.push("ajax=1");
    pairs.push("postData=1");
    pairs.push("mode="+frmMode);
    return pairs.join("&");
}


function postUserData(formMode)
{
    var status = false;
    
    var windowForm  = document.expUserData;
    var checkPost   = eval("windowForm.postData");
    checkPost.value = "yes";

    var query = createQuery(document.getElementById("expUserData"), formMode);
    var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

    http.open("post", "expRenderFormData.php", true);
    http.setRequestHeader("Content-Type", contentType);
    http.onreadystatechange = handleResponse;    
    http.send(query);
}

function handleResponse()
{
     if(http.readyState == 4)
      {

        document.getElementById("expUsserData").innerHTML=http.responseText;
    }
     else
     {

       document.getElementById("expUsserData").innerHTML="<td align = center><img src=\"./images/looploader.gif\"> </td>";
     }
}
