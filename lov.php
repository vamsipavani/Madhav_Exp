<html>
<head></head>
<body>
<?php

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;

$expListing = 'SELECT rtrim(exp_type),rtrim(exp_meaning) from exp_legend';

$result = mysql_query($expListing) or die(mysql_error());

$myArray;
$i=0;
while ($row=mysql_fetch_row($result)){
$myArray[$i] = $row;

$i++;
//echo $myArray[0];
}

foreach ($myArray as $item){

echo $item[0].','.$item[1];
}


?>