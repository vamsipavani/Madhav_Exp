<html>
<HEAD>
  <link rel=stylesheet type="text/css" href=jtfucss.css>
  <script type="text/javascript" src="chartStyles.js"></script>
</HEAD>
<body>
<?php
  $varAction1 = $_GET['action'];
  //echo $varAction1;
  $varChartStyle = $_GET['chartStyle'];
  //echo $varChartStyle ;
  
//get max cycle Id  
$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;

$getMaxCycleId = 'select max(cycle_id)
                  from expenses';

$resultMaxCycleId = mysql_query($getMaxCycleId) or die(mysql_error());
while($row = mysql_fetch_array( $resultMaxCycleId ))
{
  $maxCycleId = $row[0];
}

if ($timeLine == 'max')
{
  $currentCycleId = $maxCycleId;
  $cycleIdToUse   = $maxCycleId;
}
  
?>
<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name = "expGraphShell">
<table width=100% border =0>
    <TR>
      <td nowrap align = top><B>Timeline</B></td>
    </TR>
    <BR>
    <TR>
	  <td nowrap align = left>
	  <?php 
	    if ($cycleIdToUse > 1)
		{
	  ?>			
	      <a href="javascript:changeTimelinePrev('<?php echo $varAction1 ?>','<?php echo $varChartStyle ?>','<?php echo $cycleIdToUse ?>','prevMth');">Previous Month</a>

	    <br>
	  <?php	  
		}		
	  ?>	
	  <?php 
	    if ((int)($cycleIdToUse) < (int)($maxCycleId))
		{
	  ?>			

	    <a href="javascript:changeTimelineNext('<?php echo $varAction1 ?>','<?php echo $varChartStyle ?>','<?php echo $cycleIdToUse ?>','nextMth');">Next Month</a>
	    <br>		
	  <?php
        }
      ?>	
	  <?php 
	    if ((int)($cycleIdToUse) >= (int)($maxCycleId))
		{
	  ?>			

	    <a href="javascript:changeTimelinePrevThree('<?php echo $varAction1 ?>','<?php echo $varChartStyle ?>','<?php echo $cycleIdToUse ?>','prev3');">Previous 3 Months</a>
	    <br>		
	  <?php
        }
      ?>
	  <a href="javascript:changeTimelineYTD('<?php echo $varAction1 ?>','<?php echo $varChartStyle ?>','ytd');">Year-To-Date</a>
	  </td>
	</TR>
	
</table>
  <INPUT TYPE=hidden NAME=maxCycleId VALUE="<?php echo $maxCycleId;?>">
  <INPUT TYPE=hidden NAME=cycleIdToUse VALUE="<?php echo $cycleIdToUse;?>">

	
<table width=100% border =0>
<tr>
  <td width="15%">
    <table width=100% border =0>
    <TR>
      <td nowrap align = top><B>Chart Styles</B></td>
    </TR>
    <BR>
    <TR>
	  <td nowrap align = left>
	    <img src="/images/bar.jpg" height=25 width=25><a href="javascript:sndChartType('<?php echo $varAction1 ?>','BAR');">Bar Graph</a>
	    <br>
	    <img src="/images/pie.jpg" height=25 width=25><a href="javascript:sndChartType('<?php echo $varAction1 ?>','PIE');">Pie Graph</a>
        <br>
	    <img src="/images/line.jpg" height=25 width=25><a href="javascript:sndChartType('<?php echo $varAction1 ?>','LINE');">Line Graph</a>
	  </td>
	</TR>
	</table>
  </td>

  <td align=center width ="70%">
    <div id='chartArea'>
      <table>
        <tr>
          <td align=center>
            <img src="expGraphs.php?action=<?php echo $varAction1 ?>&chartStyle=<?php echo $varChartStyle ?>&timeline=<?php echo $timeLine ?>&cycleToUse=<?php echo $cycleIdToUse ?>&multiMode=1">
          </td>
        </tr>
      </table>
    </div>
  </td>

  <td width="15%">
    <?php include('expLegend.php');?>
  </td>
</tr>
</table>

<Table width=100% border =0>
<tr>
  <td width=15%>
  Show Details
  <?php

    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());

    $expLegend = 'select uec.cat_id, cat_meaning
              from exp_categories ec, user_exp_categories uec
              where ec.cat_id = uec.cat_id
              and uec.user_id = 1
			  order by cat_meaning';
    $result = mysql_query($expLegend) or die(mysql_error());

    echo '<SELECT name="expLegend" onchange="showExpDetails(this.value,'.$cycleIdToUse.')">';
    echo '<OPTION value=\'Select\'> Select';

    while($row = mysql_fetch_array( $result ))
    {
      echo '<OPTION value='.$row[0].'> '.$row[1].'';
    }

    echo '</select>';
  ?>

  </td>
  <td width = 70%>
    <div id='expDetailsArea'>
    </div>

  </td>
  <td width=15%>
    &nbsp;
  </td>
</tr>
</table>
</FORM>
</body>
</html>
