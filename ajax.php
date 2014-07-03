<?php

	// querystring from sndReq function
	$varAction = $_GET['action'];

	// return some new text for the someText object
	// note that in this case, I am just hardcoding some stuff for an example
	// but we could actually do something like construct a SQL statement based on
	// the 'action' querystring for MSSQL, MySQL, or whatever we want
	switch($varAction)
	{
		case "page1":
			echo("someText|<B>This is page 1.  One is the loneliest number that you ever knew.</B>");
			echo "<table width = 90% border = '1' cellspacing = '5' cellpadding = '0'>";
            echo "<tr>";
            echo "<td>";
            echo "<img src=\"upload/Picture_054.jpg\" alt=\"Angry\" width=\"70\" height=\"70\"/>";
            echo "text still works";
            include("Form1.html");
            echo "</td>";
            echo "</tr>";
            echo "</table>";
			break;
		case "page2":
			echo("someText|This is page 2222.  Two can be as bad as one; it's the loneliest number since the number 1.");
			break;
		case "page3":
			echo("someText|This is page 3.  Note that since the sndReq function is actually loading a PHP page, it can pull data from a database, XML, text file, etc.");
			break;
		case "page4":
			echo("someText|This is page 4.  This example isn't really doing anything special that normal JavaScript can't do, but all this text is coming from a seperate PHP file, so the user doesn't have to get all possible data upfront on the client side.");
			break;
	}

?>