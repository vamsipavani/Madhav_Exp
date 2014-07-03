<?php
	
	$is_ajax = $_REQUEST['is_ajax'];
	$is_register = $_REQUEST['is_register'];
	if(isset($is_ajax) && $is_ajax)
	{
		if(isset($is_register) && $is_register){
			$fname = $_REQUEST['firstname'];
			$lname = $_REQUEST['lastname'];
			$email = $_REQUEST['mailAddress'];
			$pword = $_REQUEST['pword'];

			if($fname == 'demo' && $pword == 'demo')
			{
				echo "success";	
			}		
		}	
		else{
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			
			if($username == 'demo' && $password == 'demo')
			{
				echo "success";	
			}		
		}

	}

	
?>