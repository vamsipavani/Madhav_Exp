<?php

  // querystring from sndReq function

  session_start();

  $varAction = $_GET['action'];
  $varChartStyle = $_GET['chartStyle'];
  
  if (isset($_GET['timeLine']))
  {
    $timeLine     = $_GET['timeLine'];
	$cycleIdToUse = $_GET['cycleIdToUse'];
  }  
  else
  {
    $timeLine = "max";
  }
  echo $timeLine;
  
  $_SESSION['action'] = $varAction;
  $_SESSION['chartStyle'] = $varChartStyle;
   $_SESSION['timeline'] = $timeLine;
  

  //echo $varAction;
  //echo $varChartStyle;

  require("expGraph_html.php");
?>
