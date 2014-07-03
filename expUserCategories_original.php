<html>
<head>
  <link rel=stylesheet type="text/css" href=jtfucss.css>
  <script type="text/javascript" src="ajaxRouterUserCats.js">  </script>
</head>

<body>

<?php
include_once("expCommonHeader.php");

if (isset($_GET['userAction']))
{
  echo "Get section";
  $userActionType       = $_GET['userAction'];
  $deleteRowId          = $_GET['rowId'];
  $deleteCatCode        = $_GET['rowCatCode'];

  $expDeleteRow = 'delete from exp_user_categories
                   where cat_code = '.$deleteCatCode.'
                   and uec.user_id = 1';


  $result = mysql_query($expDeleteRow) or die(mysql_error());

}



?>
<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name = "expUserCategories">
<table width=100% border =0 align="center">
<tr>
<td width=15%>
  <?php include("expProfileMenu.php"); ?>
</td>

<div id='expUserProfile'>
<td width =70%>
  <table align="center">
  <?php
    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());

    $rowCount = 0;

    $expLegend = 'select ec.cat_id, substr(cat_code,1,4), cat_meaning
                  from exp_categories ec, user_exp_categories uec
                  where ec.cat_id = uec.cat_id
                  and uec.user_id = 1';

    $legendTitle = 'Current Categories';
    $groupingQuery = $expLegend;

    $result = mysql_query($groupingQuery) or die(mysql_error());
  ?>
  <tr>
    <th class="pageTitle" align="left"> <?php echo ("$legendTitle"); ?> </th>
  </tr>
  <tr>
    <th class="tableSmallHeaderCell" align="left"> Code</th>
    <th class="tableSmallHeaderCell" align="left"> Code Meaning</th>
    <th class="tableSmallHeaderCell" align="left"> Update</th>
    <th > </th>
    <th > </th>
  </tr>

    <?php

    while($row = mysql_fetch_array( $result ))
    {
	  $expTypes[$rowCount] = $row[1];
	  //echo $row[0];
	  $expMeanings[$rowCount] = $row[2];
	  //echo $row[1];
	  print("<tr >");

 	  print("<td class=\"tableDataCell\" nowrap>");
      print("$row[1]");
  	  print("</td>");

	  print("<td class=\"tableDataCell\" nowrap>");
      print("$row[2]");
  	  print("</td>");

	  print("<td class=\"tableDataCell\" nowrap align=\"center\"><a href=javascript:UpdateUserCat($row[0],'$row[1]','delete')>");
      print("x");
  	  print("</a></td>");

	  print("<td nowrap align=\"center\">");
      print("");
  	  print("</td>");
	  print("<td nowrap align=\"center\">");
      print("");
  	  print("</td>");


	  print("</tr>");

      $rowCount++;

    }

    ?>

   </table>
   <table>
   <tr>
      <td> &nbsp </td>
      <td> &nbsp </td>
      <td> &nbsp </td>
      <td align="right"><a href="javascript:addMoreRows()">Add More   </a></td>
      <td align="right"><a href="javascript:UpdateUserCat('insert')"><IMG SRC="/images/save-changes.gif" name="pic1" border="0"></a></td>
    </tr>
  </table>
  </td>
  </div>
  <td width=15%>
  </td>
</tr>
</table>


</body>
</html>