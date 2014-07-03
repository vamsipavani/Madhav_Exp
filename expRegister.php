<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

include_once("expCommonHeader.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to the application</title>
<link rel="stylesheet" type="text/css" href="jQuery_Login_style.css" />
<!--<script type="text/javascript" src="jquery-1.5.2.min.js"></script> This was the original one-->

<script type="text/javascript" src="\jQuery_jsLibs\jquery\jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#content2").hide();
	$("#login").click(function() {
		
		var action = $("#form1").attr('action');
		var form_data = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success'){
					$("#form1").slideUp('slow', function() {
						$("#message").html("<p class='success'>You have logged in successfully!</p>");
					});
					 
				}	
				else{
					
					$("#message").html("<p class='error'>Invalid username and/or password.</p>");	
					$("#form1").hide();
				}	
			}
		});
		
		return false;
	});
	
	$("#target").click(function() {
		//alert("Handler for .click() called.");
		var action = $("#form1").attr('action');
		var form_data = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success')
					$("#form1").slideUp('slow', function() {
						$("#message").html("<p class='success'>You have logged in successfully!</p>");
					});
					
				else{
					
					$("#message").html("<p class='error'>Invalid username and/or password.</p>");	
					$("#form1").hide();
				}	
			}
		});
		
		return false;		
	});
	
	$("#registerLink").click(function() {
		$("#content").hide();
		$("#loginLbl").text("Register");
		$("#content2").show();
		
		
	});
	
});
</script>
</head>

<body>
<p>&nbsp;</p>
<div id="content">
  <h1 id="loginLbl">Login</h1>
  <form id="form1" name="form1" action="doLogin.php" method="post">
    <p>
      <label for="username">Username: </label>
      <input type="text" name="username" id="username" />
    </p>
    <p>
      <label for="password">Password: </label>
      <input type="password" name="password" id="password" />
    </p>
	<table>
	<tr>
		<td width=60%>
			<div id="target">
			<!--<input type="submit" id="login" name="login" />-->
				<a href="javascript:saveListingChanges()"><IMG SRC="/images/login.png" name="pic1" border="0" height=41 width=78>
			</div>	
		</td>
		<td>
			<div id="registerLink">
			<!--<input type="submit" id="login" name="login" />-->
				<label for="username">New User? </label>
				<a id="registerLink" href="javascript:newUser()">Register Here</a>
			</div>	
		</td>
	</tr>
	</table>	
  </form>
</div> 

<div id="content2">
  <h1 id="loginLbl">Login</h1>
  <form id="form2" name="form2" action="doRegister.php" method="post">  

		  <label for="username">Username: </label>
		  <input type="text" name="username" id="username" />
		</li>
      <label for="email">E-Mail Address: </label>
      <input type="email" name="email" id="email" />
    </p>	
    <p>
      <label for="password1">Password: </label>
      <input type="password1" name="password1" id="password1" />
    </p>
    <p>
      <label for="password2">Re-Type Password: </label>
      <input type="password2" name="password2" id="password2" />
    </p>	
    <p>
      <label for="secQuestion">Security Question: </label>
      <input type="secQuestion" name="secQuestion" id="secQuestion" />
    </p>	
    <p>
      <label for="secAnswer">Answer: </label>
      <input type="secAnswer" name="secAnswer" id="secAnswer" />
    </p>	
  </form>
  </div>
  <div id="message"></div>
 
</body>
</html>