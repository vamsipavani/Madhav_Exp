<?php

if (isset($_POST['totalRows']))
{

  $totalRowCount = $_POST['totalRows'];
  echo $totalRowCount ;
  $startRowKey   = $_POST['minRowId'];
  echo $startRowKey ;

  $totalRowCount = $totalRowCount + $startRowKey;


  $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
  mysql_select_db("analysis") or die(mysql_error());
    for ($ctr=$startRowKey; $ctr<$totalRowCount; $ctr++)
    {
      //$checkArray[$ctr] = $_POST['expChanged'.$ctr];
      if (isset($_POST['expChanged'.$ctr]))
      {
        $selectedExps[$ctr] = $_POST['expChanged'.$ctr];
      }
    }
    foreach($selectedExps as $value)
    {
    
      $expTypeSelected = $_POST['expLOV'.$value];
      $expSaveUpdates = "Update expenses set exp_type = '".$expTypeSelected."' where exp_id = ".$value;
      $resultListing = mysql_query($expSaveUpdates) or die(mysql_error());
    }
}
else
{
  print("Post not successful");
}

require("expListing_test.php");
?>


