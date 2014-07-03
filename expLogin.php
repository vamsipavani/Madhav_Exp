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

<script type="text/javascript" src="/jQuery_jsLibs/jquery/jquery-1.7.1.min.js"></script>
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
						$("#message1").html("<p class='success'>You have logged in successfully!</p>");
					});
					
				else{
					
					$("#message1").html("<p class='error'>Invalid username and/or password.</p>");	
					$("#form1").hide();
				}	
			}
		});
		
		return false;		
	});
	
	$("#d_registerLink").click(function() {
		$("#content").hide();
		$("#loginLbl1").hide();
		$("#loginLbl2").show();
		$("#content2").show();
		

		
		
	});
	
	$("#register").click(function() {

		if ($("#password1").val() != $("#password2").val()){
			alert("Passwords should match");
		}
		else{
		
			var action = $("#form2").attr('action');
			var form_data = {
				firstname: $("#fname").val(),
				lastname: $("#lname").val(),
				mailAddress: $("#email").val(),
				pword: $("#password1").val(),
				is_ajax: 1,
				is_register: 1
			};
			
			$.ajax({
				type: "POST",
				url: action,
				data: form_data,
				success: function(response)
				{
					if(response == 'success'){
						$("#form2").slideUp('slow', function() {
							$("#message2").html("<p class='success'>You have registered successfully!</p>");
						});
						 
					}	
					else{
						
						$("#message2").html("<p class='error'>Registration failed</p>");	
						$("#form2").hide();
					}	
				}
			});
			
			return false;		
		};
	});
	
});
</script>
</head>

<body>
<p>&nbsp;</p>

<div id="content">
  <h1 id="loginLbl1">Login</h1>
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
				<a href="javascript:login()"><IMG SRC="/images/Login4.png" name="pic1" border="0" height=30 width=78>
			</div>	
		</td>
		<td>
			<div id="d_registerLink">
			<!--<input type="submit" id="login" name="login" />-->
				<label for="username">New User? </label>
				<a id="registerLink" href="javascript:register()">Register Here</a>
			</div>	
		</td>
	</tr>
	</table>	
  </form>
   <div id="message1"></div>
</div> 

<div id="content2">
  <h1 id="loginLbl2">Register</h1>
  <form id="form2" name="form2" action="doLogin.php" method="post">  

	<p>
	  <label for="fname">Firstname: </label>
	  <input type="text" name="fname" id="fname" />
	</p>			
	<p>
	  <label for="lname">Lastname: </label>
	  <input type="text" name="lname" id="lname" />
	</p>			
	<p>	
      <label for="email">E-Mail Address: </label>
      <input type="text" name="email" id="email" />
    </p>
	<table>
	<tr>
		<td>
			<p>
			  <label for="password1">Password: </label>
			  <input type="password" name="password1" id="password1" />
			</p>			
		</td>
		<td>
			<p>
			  <label for="password2">Re-Type Password: </label>
			  <input type="password" name="password2" id="password2" />
			</p>			
		</td>
	</tr>
	</table>
    <!--<p>
      <label for="secQuestion">Security Question: </label>
      <input type="text" name="secQuestion" id="secQuestion" />
    </p>	
    <p>
      <label for="secAnswer">Answer: </label>
      <input type="text" name="secAnswer" id="secAnswer" />
    </p>-->
	
	<p>
		<div id="register">
			<!--<input type="submit" id="login" name="login" />-->
			<a href="javascript:register()"><IMG SRC="/images/Register2.png" name="pic1" border="0" height=30 width=100>
		</div>	
	</p>			
  </form>
    <div id="message2"></div>
</div>

 
</body>
</html>