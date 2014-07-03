<?php

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());
$needMoreRows = 'no';

if (isset($_GET['action']))
{
  $userActionType       = $_GET['action'];
  $deleteRowId          = $_GET['rowId'];
  $deleteCatCode        = $_GET['rowCat'];

  $pageMode             = $_GET['query'];

  if($userActionType == "delete")
  {
    if($pageMode == 'userCat' )
    {

      $expUpdateRow = 'delete from user_exp_categories
                       where user_exp_cat_id = '.$deleteRowId.'
                       and user_id = 1';

    }
    elseif($pageMode == 'userCards')
    {
      $expUpdateRow = 'delete from exp_cards
                       where card_id = '.$deleteRowId.'
                       and user_id = 1';

    }
    $result = mysql_query($expUpdateRow) or die(mysql_error());

  }


}
elseif(isset($_GET['moreRows']))
{
  $needMoreRows         = $_GET['moreRows'];
  $pageMode             = $_GET['query'];
  if($pageMode == 'userCat')
  {

    $newRows = 5;
  }
  elseif($pageMode == 'userCards')
  {
    $newRows = 2;
  }


}
elseif(isset($_GET['query']))
{

  $pageMode             = $_GET['query'];

}


if (isset($_POST) && isset($_POST['postData']))
{

  $pageMode    = $_POST['query'];
  if($pageMode == 'userCat')
  {

    $newRows = 5;
  }
  elseif($pageMode == 'userCards')
  {
    $newRows = 2;
  }
  for($inputCtr=0;$inputCtr<$newRows;$inputCtr++)
  {

    if(isset($_POST['catCode'.$inputCtr]))
      $userExpCode    = $_POST['catCode'.$inputCtr];
    else
      $userExpCode = "not set";

    if(isset($_POST['catMeaning'.$inputCtr]))
      $userExpMeaning = $_POST['catMeaning'.$inputCtr];

    if(($pageMode == 'userCat') && ($userExpCode != "not set"))
    {
      $insExpCats     = "insert into exp_categories(cat_code, Cat_meaning) values ('$userExpCode', '$userExpMeaning')";
      $resultIns      = mysql_query($insExpCats) or die(mysql_error());
      $insUserExpCats = "insert into user_exp_categories(user_id,cat_id) values (1,last_insert_id())";
      $resultIns      = mysql_query($insUserExpCats) or die(mysql_error());
    }
    elseif (($pageMode == 'userCards') && ($userExpCode != "not set"))
    {
      $insExpCards    = "insert into exp_cards(card_code, card_name, user_id) values ('$userExpCode', '$userExpMeaning',1)";
      $resultIns      = mysql_query($insExpCards) or die(mysql_error());
    }
    /*elseif($pageMode == 'userIdealExp')
    {
    $insExpCats     = "insert into exp_categories(cat_code, Cat_meaning) values ('$userExpCode', '$userExpMeaning')";
    $resultIns      = mysql_query($insExpCats) or die(mysql_error());
    }*/
  }
}

?>


<?php

$rowCount = 0;

$expLegend = 'select uec.user_exp_cat_id, substr(cat_code,1,4), cat_meaning
              from exp_categories ec, user_exp_categories uec
              where ec.cat_id = uec.cat_id
              and uec.user_id = 1
              order by cat_code';

$userCards = 'select card_id, card_code, card_name
              from exp_cards
              where user_id = 1';

$userIdealExp = 'select ec.cat_meaning, amount
                 from exp_categories ec, expenses e
                 where e.cat_id = ec.cat_id
                 and user_id = 1
                 and exp_tag = \'I\'';




if($pageMode == 'userCat')
{
  $groupingQuery = $expLegend;
  $legendTitle = 'Current Categories';
  $addLegendTitle = 'Add New Categories';
  $newRows = 5;
}
elseif($pageMode == 'userCards')
{
  $groupingQuery = $userCards;
  $legendTitle = 'Current Cards';
  $addLegendTitle = 'Add New Cards';
  $newRows = 2;
}
elseif($pageMode == 'userIdealExp')
{
  $groupingQuery = $userIdealExp;
  $legendTitle = 'Your Current Expenses';

}

$result = mysql_query($groupingQuery) or die(mysql_error());

?>
<table align="center">
<tr>
  <?php
    if($needMoreRows == 'yes')
    {
  ?>
  <td width = 50%>
  <?php
    }
    else
    {
  ?>
      <td width = 100%>
  <?php
    }
  ?>
    <table align="center">
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
        if($needMoreRows == 'no')
        {
	  	  print("<td class=\"tableDataCell\" nowrap align=\"center\"><a href=javascript:UpdateUserCat($row[0],'$row[1]','delete','$pageMode','no')>");
	  	}
	  	else
	  	{
	  	  print("<td class=\"tableDataCell\" nowrap align=\"center\"><a href=javascript:UpdateUserCat($row[0],'$row[1]','delete','$pageMode','yes')>");
	  	}
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
  </td>
  <?php

    if($needMoreRows == 'yes')
    {
  ?>
      <td width = 50%>
	    <table align="center">
	    <tr>
		  <th class="pageTitle" align="left"><?php echo ("$addLegendTitle"); ?> </th>
		</tr>
	    <tr>
	      <th class="tableSmallHeaderCell" align="left"> Code</th>
	      <th class="tableSmallHeaderCell" align="left"> Code Meaning</th>
	    </tr>

   <?php
      for ($newRowCounter=0;$newRowCounter<$newRows;$newRowCounter++)
      {
   	    print("<tr >");

	    print("<td class=\"tableDataCell\">");
	    print("<INPUT TYPE=text NAME=catCode$newRowCounter SIZE=4 MAXLENGTH=4>");
	    print("</td>");
   	    print("<td class=\"tableDataCell\">");
	    print("<INPUT TYPE=text NAME=catMeaning$newRowCounter SIZE=20 MAXLENGTH=20>");
	    print("</td>");

	    print("</tr>");

      }
    ?>
        </tr>
        </table>
      </td>
    <?php
    }
    ?>

</tr>

</table>