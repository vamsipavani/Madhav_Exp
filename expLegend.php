<html>
<head>
  <link rel=stylesheet type="text/css" href=jtfucss.css>
</head>
<body>
<table width=100% border =0 >
<?php
$varAction2="";
if (isset($_GET['ordClause']))
{
  $varAction2 = $_GET['action'];
}
$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;

$expLegend = 'select substr(cat_code,1,4), cat_meaning
              from exp_categories ec, user_exp_categories uec
              where ec.cat_id = uec.cat_id
              and uec.user_id = 1
			  order by cat_meaning ';
$merLegend = 'select distinct(merchant_address) merchant,\'\' from expenses';


if ($varAction2 == 'EXP')
{
  $legendTitle = 'Expense Types';
  $groupingQuery = $expLegend;
}
elseif($varAction2 == 'MER')
{
  $legendTitle = 'Merchant Legend';
  $groupingQuery = $merLegend;
}
else
{
  $legendTitle = 'Current Categories';
  $groupingQuery = $expLegend;
}

$result = mysql_query($groupingQuery) or die(mysql_error());
?>

<tr>
  <th class="pageTitle" align="left"> <?php echo ("$legendTitle"); ?> </th>
</tr>
<tr>
  <table align="left">
    <tr>
      <th class="tableSmallHeaderCell" align="left"> Code</th>
      <th class="tableSmallHeaderCell" align="left"> Code Meaning</th>
    </tr>
<?php


while($row = mysql_fetch_array( $result ))
{
	$expTypes[$rowCount] = $row[0];
	//echo $row[0];
	$expMeanings[$rowCount] = $row[1];
	//echo $row[1];
	print("<tr >");

 	print("<td class=\"tableDataCell\" nowrap>");
    print("$row[0]");
  	print("</td>");

	print("<td class=\"tableDataCell\" nowrap>");
    print("$row[1]");
  	print("</td>");


	print("</tr>");



$rowCount++;

}

?>
  </table>
</tr>
</table>
</body>
</html>