<?php

  // querystring from sndReq function
  $varAction = $_GET['action'];

?>


<html>
<head>

 <title>Expense Information</title>
</head>
<body>
<table width=100% border =0>
<tr>
  <td width="15%">
    &nbsp;
  </td>

  <td align=center width ="70%">
    <table>
    <tr>
    <td align=center>
      <H2> Expense Information </H2>
    </td>
    </tr>

    <tr>
    <td align=center>
      <img src="expGraphs.php">
    </td>
    </tr>
    </table>

  <td width="15%">
  <?php include('expLegend.php');?>
  </td>
</tr>

</table>
</body>
</html>


	// return some new text for the someText object
	// note that in this case, I am just hardcoding some stuff for an example
	// but we could actually do something like construct a SQL statement based on
	// the 'action' querystring for MSSQL, MySQL, or whatever we want
	switch($varAction)
	{