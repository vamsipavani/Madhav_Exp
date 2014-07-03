<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
</head>
<body>

<?php
$ordType = 'exp_amount';
if (isset($_GET['ordClause']))
{
  $ordType       = $_GET['ordClause'];
  print("get successful");
}

?>

<?php

    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());

    $rowCount = 0;

    $expListing = 'SELECT date_format(exp_date,\'%d %b %Y\'),rtrim(merchant_address), exp_amount, exp_type, exp_id
                   from expenses
                   where user_id = 1
                   and exp_tag = \'r\'
                   order by '.$ordType.' desc';

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
  <div id='expListingArea'>
  <FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name = "expListing">
  <table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>

  <tr >
    <th class=pageTitle align="left"> Categorize Expenses </th>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td align="right"><a href="javascript:saveListingChanges()"><IMG SRC="/images/save-changes.gif" name="pic1" border="0"></a></td>
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>

    <th class="jttinvis" align="left"> Select</th>

    <th class="tableSmallHeaderCell" align="left"> Date Of Transaction</th>

    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByMer('merchant_address')">Merchant Name </a></th>

    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByAmt('exp_amount')">Amount </a></th>

    <th class="tableSmallHeaderCell" align="left"> Type </th>
  </tr>

  <?php


    while($row = mysql_fetch_array( $resultListing ))
    {
	  $expDate[$rowCount] = $row[0];
	  //echo $row[0];
	  $expMerchant[$rowCount] = $row[1];
	  $expAmount[$rowCount] = $row[2];
	  $expId[$rowCount] = $row[4];

	  if($rowCount == 0)
	    $startRowId = $row[4];

	  //echo substr($row[3],0,4).".........".$row[3];
	  print("<tr onMouseOver=\"this.bgColor='lightblue';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");

 	  print("<td class=\"jttinvis\">");
      print("<input type=\"checkbox\" name=\"expChanged$row[4]\" value=\"$row[4]\" UNCHECKED >");
  	  print("</td>");

 	  print("<td class=\"tableDataCell\" nowrap >");
      print("$row[0]");
  	  print("</td>");

	  print("<td class=\"prompt\" nowrap>");
      print("$row[1]");
  	  print("</td>");

 	  print("<td class=\"tableDataCell\" nowrap>");
      print("$row[2]");
  	  print("</td>");

 	  print("<td class=\"tableDataCell\" nowrap>");
      print("<select name=\"expLOV$row[4]\" onChange=\"setNeedToUpdateFlag($row[4]);return true;\" >");

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
  <INPUT TYPE=hidden NAME=totalRows VALUE="<?php echo $rowCount;?>">
  <INPUT TYPE=hidden NAME=minRowId VALUE="<?php echo $startRowId;?>">
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>
  <tr>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td align="right"><a href="javascript:saveListingChanges()"><IMG SRC="/images/save-changes.gif" name="pic1" border="0"></a></td>

  </tr>
  </table>
  </div>
</body>
</html>

