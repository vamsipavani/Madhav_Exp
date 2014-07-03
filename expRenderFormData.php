<?php

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

if (isset($_POST) && isset($_POST['postData']))
{
    $pageMode = $_POST['mode'];
    if(isset($_POST['salary']))
    {
      $formSalary   = $_POST['salary'];
      $upadateUser = "Update users set monthly_sal = ".$formSalary." where user_id = 1";
      $resultUpdate = mysql_query($upadateUser ) or die(mysql_error());
    }
    if(isset($_POST['target']))
	{
	  $formTarget   = $_POST['target'];
	  $upadateUser = "Update users set annual_saving_target = ".$formTarget." where user_id = 1";
	  $resultUpdate = mysql_query($upadateUser ) or die(mysql_error());
    }
}


if (isset($_GET['mode']))
{
  $pageMode = $_GET['mode'];

}

$expUserData = 'select user_name, user_password, monthly_sal, billing_cycle, annual_saving_target
               from users
               where user_id = 1';


$result = mysql_query($expUserData ) or die(mysql_error());


$pageTitle = "View User Data";

if($pageMode == 'edit')
$pageTitle = "Edit User Data";

?>
<table align="center" border=0>
<tr>


	  <th class="pageTitle" align="left"> <?php echo ("$pageTitle"); ?> </th>
	  <th class="pageTitle" align="left"></th>
</tr>
    <?php

	  while($row = mysql_fetch_array( $result ))
	  {
	  	print("<tr >");

	    print("<td class=\"tableDataCell\" nowrap>");
	    print("User Name");
	    print("</td>");

	    print("<td class=\"tableDataCell\" nowrap>");

        print("$row[0]");
	    print("</td>");
	    print("</tr >");

	  	print("<tr >");
	    print("<td class=\"tableDataCell\" nowrap>");
	    print("Password");
	    print("</td>");

	  	print("<td class=\"tableDataCell\" nowrap>");
        print("$row[1]");
	    print("</td>");
  	    print("</tr >");

	  	print("<tr >");
	    print("<td class=\"tableDataCell\" nowrap>");
	    print("Monthly Salary");
	    print("</td>");

	  	print("<td class=\"tableDataCell\" nowrap>");
		if($pageMode == 'edit')
        {
	      print("<INPUT TYPE=text NAME=salary value= $row[2] SIZE=10 MAXLENGTH=10>");
	    }
	    else
	    {
	      print("$row[2]");
	    }
	    print("</td>");
  	    print("</tr >");

	  	print("<tr >");
	    print("<td class=\"tableDataCell\" nowrap>");
	    print("Billling Cycle");
	    print("</td>");

        print("$row[3]");
	    print("</td>");
  	    print("</tr >");

	  	print("<tr >");
	    print("<td class=\"tableDataCell\" nowrap>");
	    print("Annual Savings Target");
	    print("</td>");

	  	print("<td class=\"tableDataCell\" nowrap>");
		if($pageMode == 'edit')
        {
	      print("<INPUT TYPE=text NAME=target value= $row[4] SIZE=15 MAXLENGTH=15>");
	    }
	    else
	    {
	      print("$row[4]");
	    }
	    print("</td>");
  	    print("</tr >");


	  }

	?>

</table>