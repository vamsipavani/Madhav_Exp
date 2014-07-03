<?php
$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
echo "Connected to MySQL<br />";
mysql_select_db("analysis") or die(mysql_error());
echo "Connected to Database";

?>
