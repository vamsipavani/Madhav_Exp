<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterExpListing.js">  </script>
</head>
<body>

<?php

//include_once("expCommonHeader.php");

?>

  <FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name = "expListing">
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
	<select name="billMonth" ">
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
	<select name="billYear" ">
	   <option value="2007"> 2007</option>
	   <option value="2008"> 2008</option>
	   <option value="2009"> 2009</option>
	   <option value="2010"> 2010</option>
	   <option value="2011"> 2011</option>
    </select>		
	<INPUT TYPE="button" NAME="button" Value="Go" onClick="changeBillCycle(this.form)">
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
  </table>
  <div id="expListingDataArea">


    <?php

      include("expListingData.php");
    ?>
    </div>
<table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>	
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

