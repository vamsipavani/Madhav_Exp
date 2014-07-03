<table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>
    <th class="jttinvis" align="left"></th>
    <th class="jttinvis" align="left"></th>
    <th class="jttinvis" align="left"></th>
    <th class="jttinvis" align="left"></th>
    <th class="jttinvis" align="left"></th>
    <th class="jttinvis" align="left"></th>


<?php	


    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());

	$ordType = 'exp_date';

if (isset($_GET['ordClause']))
{
	if ($_GET['ordClause'] =='a'){
	  $ordType = 'exp_amount';
    }
	elseif ($_GET['ordClause'] =='m'){
	  $ordType = 'merchant_address';
    }
}
if (isset($_GET['dateChanged']))
{
  $dateModified = "y";
}

if (isset($_GET['billingMonth']))
{
  $billingMonth       = $_GET['billingMonth'];
  
}
if (isset($_GET['billingYear']))
{
  $billingYear       = $_GET['billingYear'];
}

if (isset($_POST['totalRows']))
{

  $totalRowCount = $_POST['totalRows'];
  $startRowKey   = $_POST['minRowId'];

  $totalRowCount = $totalRowCount + $startRowKey;
  
  
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
    $rowCount = 0;
	//to display results only from the latest upload	
	if (isset($billingMonth) && isset($billingYear) && $billingMonth != 0)
	{
	  
	  $getCycleId = 'select cycle_id from expenses 
	                 where billing_month = '.$billingMonth.'
					 and billing_year = '.$billingYear;
	}
	else 
	{
	  $getCycleId = 'select max(cycle_id) from expenses';
	}
	
    $resultCycleId = mysql_query($getCycleId) or die(mysql_error());
	
    while($row = mysql_fetch_array( $resultCycleId ))
    {
      $cycleId = $row[0];
    }
	
	if ( is_null($cycleId)){
	   echo 'no data found';
	}
	else{
	
		//Query to get the listings from expenses
		$expListing = 'SELECT date_format(exp_date,\'%d %b %Y\'),rtrim(merchant_address), exp_amount, cat_id, exp_id
					   from expenses
					   where user_id = 1
					   and cycle_id = '.$cycleId.'
					   order by '.$ordType.' desc';
					   
		//echo $expListing;			   
		$resultListing = mysql_query($expListing) or die(mysql_error());
		
		//Query to get the categories from exp_categories
		$expLOV =  'select uec.cat_id,cat_meaning, cat_code
					from user_exp_categories uec, exp_categories ue
					where uec.cat_id = ue.cat_id
					and uec.user_id = 1
					order by cat_code ';
		$resultLOV = mysql_query($expLOV) or die(mysql_error());

		$expMinExpId = 'SELECT min(exp_id) from expenses where cycle_id = '.$cycleId;
		$resultMinExpId = mysql_query($expMinExpId) or die(mysql_error());

		$lovArray;
		while ($row=mysql_fetch_row($resultLOV))
		{
		  $lovArray[$i] = $row;
		  $i++;
		}	
		$i=0;
		//Put LOV results into an array
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

		  print("<td class=\"tableDataCell\" nowrap width=180>");
		  print("$row[0]");
		  print("</td>");
		  
		  //merchant 
		  print("<td width=280 class=\"prompt\" nowrap onMouseOver=\"this.bgColor='lightblue';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");
		  print("$row[1]");
		  print("</td>");
		  
		  //Amount  
		  print("<td class=\"tableDataCell\"  width=55 nowrap>");
		  print("$row[2]");
		  print("</td>");

		  print("<td class=\"tableDataCell\" width=60 nowrap>");
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

		  print("</select>");
		  print("</td>");

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
	}
  ?>
  </table>
