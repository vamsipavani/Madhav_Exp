<?php

  $varExpType = $_GET['type'];
  $cycleIdToUse = $_GET['cycleIdToUse'];


$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());


$getMaxCycleId = 'select max(cycle_id)
                  from expenses';

$resultMaxCycleId = mysql_query($getMaxCycleId) or die(mysql_error());
while($row = mysql_fetch_array( $resultMaxCycleId ))
{
  $maxCycleId = $row[0];
}



$expDetails = 'SELECT exp_date,merchant_address,exp_amount
               from expenses
               where cat_id = '.$varExpType.' and cycle_id = '.$cycleIdToUse.' order by exp_amount desc';


$result = mysql_query($expDetails) or die(mysql_error());

?>

<table width=100% border=0>
  <tr>
    <th class="tableSmallHeaderCell" align="left"> Date</th>
    <th class="tableSmallHeaderCell" align="left"> Merchant Details</th>
    <th class="tableSmallHeaderCell" align="left"> Amount</th>
  </tr>
  <?php
    while($row = mysql_fetch_array( $result ))
	{
	  echo '<tr>';
	  echo '<td class="tableDataCell" nowrap>'.$row[0].'</td>';
	  echo '<td class="tableDataCell" nowrap>'.$row[1].'</td>';
	  echo '<td class="tableDataCell" nowrap>'.$row[2].'</td>';
	  echo '</tr>';
    }

    ?>

</table>
