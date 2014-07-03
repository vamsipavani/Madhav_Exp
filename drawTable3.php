<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
</head>
<body>

<?php

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;

$expListing = 'SELECT date_format(exp_date,\'%d %b %Y\'),rtrim(merchant_address), exp_amount, exp_type from expenses';

$resultListing = mysql_query($expListing) or die(mysql_error());

$expLOV = 'SELECT rtrim(exp_type),rtrim(exp_meaning) from exp_legend';

$resultLOV = mysql_query($expLOV) or die(mysql_error());

$lovArray;
$i=0;
while ($row=mysql_fetch_row($resultLOV))
{
  $lovArray[$i] = $row;
  $i++;
}

?>
<table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center>

  <tr >
    <td class=pageTitle align="left"> Categorize Expenses </th>
  </tr>
  <tr >
    <td> &nbsp </td>
  </tr>
  <tr>

    <th class="tableSmallHeaderCell" align="left"> Date Of Transaction</th>

    <th class="tableSmallHeaderCell" align="left"> Merchant Name </th>

    <th class="tableSmallHeaderCell" align="left"> Amount </th>

    <th class="tableSmallHeaderCell" align="left"> Type </th>
  </tr>
<?php


while($row = mysql_fetch_array( $resultListing ))
{
	$expDate[$rowCount] = $row[0];
	//echo $row[0];
	$expMerchant[$rowCount] = $row[1];
	$expAmount[$rowCount] = $row[2];
	//echo substr($row[3],0,4).".........".$row[3];
	print("<tr onMouseOver=\"this.bgColor='lightblue';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");

 	print("<td class=\"jttinvis\">");
    print("<input type=\"checkbox\" name=\"expType\" value=\"\" >");
  	print("</td>");

 	print("<td class=\"tableDataCell\" nowrap >");
    print("$row[0]");
  	print("</td>");

	print("<td class=\"prompt\" nowrap>");
    print("<font face=\"Verdana\">$row[1]</font>");
  	print("</td>");

 	print("<td class=\"tableDataCell\" nowrap>");
    print("$row[2]");
  	print("</td>");

 	print("<td class=\"tableDataCell\" nowrap>");
    print("<select name=\"expLOV\">");
    foreach ($lovArray as $item)
    {
      if(substr($row[3],0,4) == $item[0])
      {
        print("<option selected value=\"$item[0]\">$item[1]</option>");
      }
      else
      {
        print("<option value=\"$item[0]\">$item[1]</option>");
      }
    }

  	print("</td>");
    print("</select>");



	print("</tr>");



$rowCount++;

}

?>

</body>
</html>


