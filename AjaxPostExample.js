/**
 *  contact.js - An AJAX-based contact script
 *
 *  Copyright 2005 Infocraft
 *  http://www.infocraft.com/
 *
 *  You may use this script in its entirety, modify it to suit your needs,
 *  adapt its functions, or just use it for inspiration.  However, some form
 *  of acknowledgement, especially a link back to http://www.infocraft.com/,
 *  is always appreciated.
 */

/******************************************************************************
	Adjustable Parameters
 ******************************************************************************/

// Make sure to change these based on your settings!

var formID  = "contact";    // The ID of the contact form element
var portURL = "/contact/";  // The URL of AJAX processing script

/******************************************************************************
	Global Variables
 ******************************************************************************/

var request;

/******************************************************************************
	Intialization
 ******************************************************************************/

addEvent(window, "load", initContact);

function initContact()
{
	if (form = document.getElementById(formID))
		form.onsubmit = validate;
}

/******************************************************************************
	Primary Functions
 ******************************************************************************/

// Validates the form and sends the XML request if valid
function validate()
{
	var form    = document.getElementById(formID);
	var name    = form.name.value;
	var email   = form.email.value;
	var subject = form.subject.value;
	var message = form.message.value;

	var emailFormat = /^[\w\.\-]+@[\w\.\-]+\.[\w\.\-]+$/;

	var errors = "";
	var submit;

	// Check required elements
	if (!name)
		errors += "- Your name is required.\n"
	if (!email)
		errors += "- Your email address is required.\n"
	if (!subject)
		errors += "- A subject is required.\n"
	if (!message)
		errors += "- A message is required.\n"

	// Check formatted values
	if (email && !email.match(emailFormat))
		errors += "- Your email address must be in 'yourname@domain.com' format.\n";

	if (!errors) {
		var query = createQuery(form);

		if (postAJAX(portURL, query, processResponse)) {
			submit = false;
		} else {
			submit = true;
		}

	} else {
		submit = false;
		alert("Your message could not be sent:\n\n" + errors);
	}

	return submit;
}

// Processes the information from a returned count XML
function processResponse()
{
	if (request.readyState == 4) {
		var form = document.getElementById(formID);
		
		if (response = request.responseXML) {

			var code = getNodeValue(response, "code");
			var text = getNodeValue(response, "text");
			
			if (code == 1) {
				removeForm();
			} else {
				form.submit();
			}

		} else {
			form.submit();	
		}
	}
}

// On successful mailing, removes the contact form and displays feedback
function removeForm()
{
	var form = document.getElementById(formID);
	var container = form.parentNode;
	var paragraph = container.getElementsByTagName("p")[0];

	container.removeChild(form);
	setText(paragraph, "Your message was successfully sent.");

}

/******************************************************************************
	Event Registration Functions
 ******************************************************************************/

// Adds an event handler to an element
function addEvent(element, type, handler)
{
    if (element.addEventListener) {
        element.addEventListener( type, handler, false );
    } else if (element.attachEvent) {
        element["e" + type + handler] = handler;
        element[type + handler] = function() { element["e" + type + handler](window.event); }
        element.attachEvent("on" + type, element[type + handler]);
    }
}

// Removes an event handler from an element
function removeEvent(element, type, handler)
{
    if (element.removeEventListener) {
        element.removeEventListener(type, handler, false);
    } else if (element.detachEvent) {
        element.detachEvent("on" + type, element[type+handler]);
        element[type+handler] = null;
    }
}

/******************************************************************************
	AJAX Functions
 ******************************************************************************/

// Creates a URL-encoded query to send as an XMLHttpRequest
function createQuery(form)
{
	var elements = form.elements;
	var pairs = new Array();

	for (var i = 0; i < elements.length; i++) {

		if ((name = elements[i].name) && (value = elements[i].value))
			pairs.push(name + "=" + encodeURIComponent(value));
	}

	pairs.push("ajax=1");

	return pairs.join("&");
}

// Send a query as a POST to a given URL and handle with the given handler
function postAJAX(url, query, handler)
{
    var status = false;
	var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

	// Native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
		request.onreadystatechange = handler;
		request.open("post", url, true);
        request.setRequestHeader("Content-Type", contentType);
		request.send(query);
        status = true;

	// ActiveX XMLHttpRequest object
	} else if (window.ActiveXObject) {
		request = new ActiveXObject("Microsoft.XMLHTTP");
		if (request) {
			request.onreadystatechange = handler;
			request.open("post", url, true);
            request.setRequestHeader("Content-Type", contentType);
			request.send(query);
            status = true;
		}
	}

    return status;
}

/******************************************************************************
	Utility Functions
 ******************************************************************************/

// Processes the information from a returned count XML
function getNodeValue(topNode, tagName)
{
	if ((tags = topNode.getElementsByTagName(tagName)) && tags[0].firstChild)
			value = tags[0].firstChild.data;
	else
		value = '';

	return value;
}

// Sets the text of an element (element should be empty or first child text)
function setText(element, text)
{
	var textNode = document.createTextNode(text);

	if (element.firstChild)
		element.replaceChild(textNode, element.firstChild);
	else
		element.appendChild(textNode);
}

