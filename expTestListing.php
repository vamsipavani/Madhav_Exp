<html lang=en>
<head>
<title>Personal Expense Analyzer</title>
<meta name="author" content="Madhav Annamraju">
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterExpListing.js">  </script>

</head>
<body>
  <table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>

  <tr >
    <th class=pageTitle align="left"> Categorize Expenses </th>
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
    <td> &nbsp </td>
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
	<td> &nbsp </td>
    <td align="right"><a href="javascript:location.href='expAddExpenses.php'"><IMG SRC="/images/AddMore.gif" name="pic1" alt="The Web Design Group" border="0" height=20 width=90></a></td>
    <td align="right"><a href="javascript:saveListingChanges()"><IMG SRC="/images/save.gif" name="pic2" alt="The Web Design Group" border="0" height=20 width=110></a></td>
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>
  </table>
  <FORM >
  
  <table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>

  <tr>

    <th class="jttinvis" align="left"> Select</th>
    <th class="tableSmallHeaderCell" align="left"> Date Of Transaction</th>
    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByMer()">Merchant Name </a></th>
    <th class="tableSmallHeaderCell" align="left"> <a href="javascript:orderByAmt()">Amount </a></th>
    <th class="tableSmallHeaderCell" align="left"> Type </th>
    <th  align="left"> </th>
	
  </tr>
  <tr >
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>

  </tr>  
  </table>
  <div id="expListingDataArea">


    <?php

      include("expListingData.php");
    ?>
	
  
  </div>

  </form>
  <table cellpadding="1" cellspacing="1" class="OraBGAccentDark" width=800 align=center border =0>
  <tr >
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp;</td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>

  </tr>
  <tr>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
	<td> &nbsp; </td>
  </tr>
  </table>  
</body>
</html>

