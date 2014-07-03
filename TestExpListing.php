<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterExpListing.js">  </script>
</head>
<body>

<?php

include_once("expCommonHeader.php");

$ordType = 'exp_date';
$billingMonth = 0;
$billingYear = 0;

if (isset($_GET['ordClause']))
{
  $ordType       = $_GET['ordClause'];
}
if (isset($_GET['dateChanged']))
{
  echo "Date changed";
}
if (isset($_GET['billingMonth']))
{
  $billingMonth       = $_GET['billingMonth'];
  
}
if (isset($_GET['billingYear']))
{
  $billingYear       = $_GET['billingYear'];
  echo "After get"+$billingYear;
}

if (isset($_POST['totalRows']))
{

  $totalRowCount = $_POST['totalRows'];
  $startRowKey   = $_POST['minRowId'];

  $totalRowCount = $totalRowCount + $startRowKey;

  $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
  mysql_select_db("analysis") or die(mysql_error());
    for ($ctr=$startRowKey; $ctr<$totalRowCount; $ctr++)
    {
      if (isset($_POST['expChanged'.$ctr]))
      {
        $selectedExps[$ctr] = $_POST['expChanged'.$ctr];
      }
    }
    foreach($selectedExps as $value)
    {
      $expTypeSelected = $_POST['expLOV'.$value];

      $getMerData = "select substr(merchant_address,1,8), merchant_address, ex.cat_id, cat_code
                     from expenses ex, exp_categories ec
                     where ex.cat_id = ec.cat_id
                     and ex.exp_id = ".$value;

      $resultGetMerData = mysql_query($getMerData) or die(mysql_error());

      while($row = mysql_fetch_array( $resultGetMerData ))
      {
        $merchantName    = $row[0];
        $merchantAddress = $row[1];
        $merchantCatId   = $row[2];
        $merchantCatCode = $row[3];
      }

      if ($merchantCatCode == 'UNKN')
      {
        $addMerData = "insert into exp_merchants(mer_name, mer_address, cat_id)
                       values('$merchantName','$merchantAddress', '$expTypeSelected')";
        $addMerData = mysql_query($addMerData) or die(mysql_error());
      }
      $expSaveUpdates = "Update expenses set cat_id = '".$expTypeSelected."' where exp_id = ".$value;

      $resultListing = mysql_query($expSaveUpdates) or die(mysql_error());
    }
}

?>

<?php

    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());

    $rowCount = 0;

    $getMaxCycleId = 'select max(cycle_id), max(billing_year) from expenses';
    $resultMaxCycleId = mysql_query($getMaxCycleId) or die(mysql_error());
    while($row = mysql_fetch_array( $resultMaxCycleId ))
    {
      $maxCycleId = $row[0];
	  $maxYearId = $row[1];
     }

	/*if (isset($billingMonth) && isset($billingYear))
	{
	  $maxCycleId = $billingMonth;
	  $maxYearId  = $billingYear;
	}*/	 
	 //echo  $maxCycleId;
	//Query to get the listings from expenses
    $expListing = 'SELECT date_format(exp_date,\'%d %b %Y\'),rtrim(merchant_address), exp_amount, cat_id, exp_id
                   from expenses
                   where user_id = 1
                   and cycle_id = '.$maxCycleId.'
                   order by '.$ordType.' desc';	  

    $resultListing = mysql_query($expListing) or die(mysql_error());

    //$expLOV = 'SELECT rtrim(exp_type),rtrim(exp_meaning) from exp_legend';
	//Query to get the categories from exp_categories
    $expLOV =  'select uec.cat_id,cat_meaning, cat_code
                from user_exp_categories uec, exp_categories ue
                where uec.cat_id = ue.cat_id
                and uec.user_id = 1
                order by cat_code ';
    $resultLOV = mysql_query($expLOV) or die(mysql_error());

    $expMinExpId = 'SELECT min(exp_id) from expenses where cycle_id = '.$maxCycleId;
    $resultMinExpId = mysql_query($expMinExpId) or die(mysql_error());

    $lovArray;
    $i=0;
    while ($row=mysql_fetch_row($resultLOV))
    {
      $lovArray[$i] = $row;
      $i++;
    }

  ?>

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
    <td class="promptReadOnly" align="left"> 
	Select a billing cycle 
	</td>
    <td> 
	<select name="billMonth" onchange="changeBillCycle()">
       <option value="1">  January-February  </option>
       <option value="2">  February-March    </option>
       <option value="3">  March-April       </option>
	   <option value="4">  April-May         </option>
	   <option value="5">  May-June          </option>
	   <option value="6">  June-July         </option>
	   <option value="7">  July-August       </option>
	   <option value="8">  August-September  </option>
	   <option value="9">  September-October </option>
	   <option value="10"> October-November  </option>
	   <option value="11"> November-December </option>
	   <option value="12"> December-January  </option>
    </select> 
	<select name="billYear" onchange="changeBillCycle()">
       <option value="2000"> 2000</option>
       <option value="2001"> 2001</option>
       <option value="2002"> 2002</option>
	   <option value="2003"> 2003</option>
	   <option value="2004"> 2004</option>
	   <option value="2005"> 2005</option>
	   <option value="2006"> 2006</option>
	   <option value="2007"> 2007</option>
	   <option value="2008"> 2008</option>
	   <option value="2009"> 2009</option>
	   <option value="2010"> 2010</option>
    </select>		
	</td>
    <td> &nbsp </td>
    <td align="right"><a href="javascript:location.href='expAddExpenses.php'"><IMG SRC="/images/AddMore.gif" name="pic1" border="0" height=20 width=90></a></td>
    <td align="right"><a href="javascript:saveListingChanges()"><IMG SRC="/images/save.gif" name="pic1" border="0" height=20 width=110></a></td>
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>
  <tr>

    <th class="jttinvis" align="left"> Select</th>

    <th class="tableSmallHeaderCell" align="left"> Date Of Transaction</th>

    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByMer('merchant_address')">Merchant Name </a></th>

    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByAmt('exp_amount')">Amount </a></th>

    <th class="tableSmallHeaderCell" align="left"> Type </th>

    <th  align="left"> </th>
  </tr>  
  <div id="expListingArea">


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
	  print("<tr >");

 	  print("<td class=\"jttinvis\">");
      print("<input type=\"checkbox\" name=\"expChanged$row[4]\" value=\"$row[4]\" UNCHECKED > ".$row[4]);
  	  print("</td>");

 	  print("<td class=\"tableDataCell\" nowrap >");
      print("$row[0]");
  	  print("</td>");
      
	  //merchant 
	  print("<td class=\"prompt\" nowrap onMouseOver=\"this.bgColor='lightblue';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");
      print("$row[1]");
  	  print("</td>");
      
	  //Amount  
 	  print("<td class=\"tableDataCell\" nowrap>");
      print("$row[2]");
  	  print("</td>");
      
	  //category selection
 	  print("<td class=\"tableDataCell\" nowrap>");
      print("<select name=\"expLOV$row[4]\" onChange=\"setNeedToUpdateFlag($row[4]);return true;\" >");

      foreach ($lovArray as $item)
      {
        if($row[3] == $item[0])
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

	  print("<td nowrap align=center>");
      if($row[3] == 12)
      {
        print("<IMG SRC=\"/images/Unknown.JPG\" name=\"pic1\" border=\"0\" alt = \"Unknown Category\" height=14 width=20>");
      }
  	  print("</td>");

      print("</tr>");

      $rowCount++;

    }

    while($row = mysql_fetch_array( $resultMinExpId))
    {
	  $startRowId = $row[0];
	}

  ?>
    </div>
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
    <td align="right"><a href="javascript:location.href='expAddExpenses.php'"><IMG SRC="/images/AddMore.gif" name="pic1" border="0" height=20 width=90></a></td>
    <td align="right"><a href="javascript:saveListingChanges()"><IMG SRC="/images/save.gif" name="pic1" border="0" height=20 width=110></a></td>
    <td> &nbsp </td>
  </tr>
  </table>

</body>
</html>

