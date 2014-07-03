<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterExpListing.js">  </script>

 <title>Add Expenses</title>
</head>
<body>

<?php
   include_once("expCommonHeader.php");
if (isset($_POST['needSave']))
{

  $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
  mysql_select_db("analysis") or die(mysql_error());
    for ($ctr=0; $ctr<1; $ctr++)
    {
      if (isset($_POST['expDate'.$ctr]) && isset($_POST['expMer'.$ctr]) && isset($_POST['expAmt'.$ctr]))
      {
        $newExpDate = $_POST['expDate'.$ctr];
        echo $newExpDate ;

        $newExpMer  = $_POST['expMer'.$ctr];
        $newExpAmt  = $_POST['expAmt'.$ctr];
        $newExpType = $_POST['expLOV'.$ctr];

        echo $newExpType;

        $expInsert = "insert into expenses(exp_date,
                                           exp_desc,
                                           merchant_address,
                                           exp_amount,
                                           cycle_id,
                                           exp_tag,
                                           cat_id,
                                           user_id)

                      values(              STR_TO_DATE('$newExpDate','%m/%d/%Y'),
                                           '',
                                           '$newExpMer',
                                           $newExpAmt,
                                           1,
                                           'u',
                                           $newExpType,
                                           1           )";

        echo $expInsert;
        $resultListing = mysql_query($expInsert) or die(mysql_error());

        echo "Insert done";
      }

    }
    header("Location: expListing.php");
}

?>
<BR>
<BR>

<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name = "expAddExpenses">
<table width=100% border =0>
<tr>

  <td width=15%>
    &nbsp;
  </td>

  <td width=70%>

    <table width=100% border =0>

    <tr>
      <td> &nbsp; </td>
      <td> &nbsp; </td>


      <td align="right"><a href="javascript:location.href='expListing.php'"><IMG SRC="/images/Cancel.gif" name="pic1" border="0" height=20 width=70></a></td>
      <td align="right"><a href="javascript:saveNewExpenses()"><IMG SRC="/images/save.gif" name="pic1" border="0" height=20 width=110></a></td>
    </tr>

    <tr>
      <td> &nbsp; </td>
    </tr>

    <tr>
      <th class="tableSmallHeaderCell" align="left"> Date Of Transaction</th>
      <th class="tableSmallHeaderCell" align="left">Merchant Name </a></th>
      <th class="tableSmallHeaderCell" align="left">Amount </a></th>
      <th class="tableSmallHeaderCell" align="left"> Type </th>
    </tr>

    <?php

    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());


    $expLOV =  'select uec.cat_id,cat_meaning, cat_code
                from user_exp_categories uec, exp_categories ue
                where uec.cat_id = ue.cat_id
                and uec.user_id = 1
                order by cat_code ';
    $resultLOV = mysql_query($expLOV) or die(mysql_error());
    $lovArray;
    $i=0;
    while ($row=mysql_fetch_row($resultLOV))
    {
      $lovArray[$i] = $row;
      $i++;
    }

    for ($newRowCounter=0;$newRowCounter<5;$newRowCounter++)
    {
   	    print("<tr >");

	    print("<td class=\"tableDataCell\">");
	    print("<INPUT TYPE=text NAME=expDate$newRowCounter SIZE=11 MAXLENGTH=11>");
	    print("</td>");
   	    print("<td class=\"tableDataCell\">");
	    print("<INPUT TYPE=text NAME=expMer$newRowCounter SIZE=70 MAXLENGTH=70>");
	    print("</td>");
	    print("<td class=\"tableDataCell\">");
	    print("<INPUT TYPE=text NAME=expAmt$newRowCounter SIZE=11 MAXLENGTH=11>");
	    print("</td>");

 	    print("<td class=\"tableDataCell\" nowrap>");
        print("<select name=\"expLOV$newRowCounter\">");

        foreach ($lovArray as $item)
        {

          print("<option value=\"$item[0]\">$item[1]</option>");

        }

  	    print("</td>");
        print("</select>");


	    print("</tr>");

    }
    ?>
    <INPUT TYPE=hidden NAME=needSave VALUE="<?php echo $newRowCounter;?>">
    <tr>
      <td> &nbsp; </td>
    </tr>
    <tr>
      <td> &nbsp; </td>
      <td> &nbsp; </td>
      <td align="right"><a href="javascript:location.href='expListing.php'"><IMG SRC="/images/Cancel.gif" name="pic1" border="0" height=20 width=70></a></td>
      <td align="right"><a href="javascript:saveNewExpenses()"><IMG SRC="/images/save.gif" name="pic1" border="0" height=20 width=110></a></td>
    </tr>
    </table>
  </td>

  <td>
    &nbsp;
  </td>


</body>
</html>
