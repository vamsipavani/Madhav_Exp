<?php
$groupType = $_GET['action'];
$graphMultiMode = $_GET['multiMode'];
$graphStyle = $_GET['chartStyle'];
$timeLine = $_GET['timeline'];

$cycleIdToUse = $_GET['cycleToUse'];

include ("PHPGraphics/src/jpgraph.php");
if($graphStyle =='BAR')
{
  include ("PHPGraphics/src/jpgraph_bar.php");
}
if($graphStyle =='PIE')
{
  include ("PHPGraphics/src/jpgraph_pie.php");
  include ("PHPGraphics/src/jpgraph_pie3d.php");
}
if($graphStyle =='LINE')
{
  include ("PHPGraphics/src/jpgraph_line.php");
}

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;

$expTypeQuery1 = "SELECT substr(cat_code,1,4),sum(exp_amount)
                 from expenses exp, exp_categories ec
                 where exp.cat_id = ec.cat_id
                 and cycle_id = ".$cycleIdToUse." group by ec.cat_id
                 order by substr(cat_code,1,4)";

if ($timeLine == 'prev3')
{				 
  $expTypeQuery2 = "SELECT substr(cat_code,1,4),sum(exp_amount)
                 from expenses exp, exp_categories ec
                 where exp.cat_id = ec.cat_id
                 and cycle_id = ".((int)($cycleIdToUse)-1)." group by ec.cat_id
                 order by substr(cat_code,1,4)";
				 
  $expTypeQuery3 = "SELECT substr(cat_code,1,4),sum(exp_amount)
                 from expenses exp, exp_categories ec
                 where exp.cat_id = ec.cat_id
                 and cycle_id = ".((int)($cycleIdToUse)-2)." group by ec.cat_id
                 order by substr(cat_code,1,4)";				 
}

elseif($timeLine == 'ytd'){
$expTypeQuery1 = "SELECT substr(cat_code,1,4),sum(exp_amount)
                 from expenses exp, exp_categories ec
                 where exp.cat_id = ec.cat_id
                 and year(exp_date) = year(current_date) -1
				 group by ec.cat_id
                 order by substr(cat_code,1,4)";
}


if ($timeLine == 'ytd'){
$merTypeQuery = "SELECT substr(merchant_address,1,8),sum(exp_amount) from expenses where year(exp_date) = year(current_date) group by substr(merchant_address,1,8)";
}
else{
$merTypeQuery = "SELECT substr(merchant_address,1,8),sum(exp_amount) from expenses where cycle_id = ".$cycleIdToUse." group by substr(merchant_address,1,8)";
}

//$groupType ='EXP';
if ($groupType == 'EXP')
{
  $queryToUse = $expTypeQuery1;
}
else
{
  $queryToUse = $merTypeQuery;
}

$result1 = mysql_query($queryToUse) or die(mysql_error());

$expTypes;
$expAmounts1;

while($row = mysql_fetch_array( $result1 ))
{
	$expTypes[$rowCount] = $row[0];
	$expAmounts1[$rowCount] = $row[1];


$rowCount++;

}
$result = mysql_query("select Max(date_format(exp_date,'%M %Y')) from expenses where cycle_id = ".$cycleIdToUse) or die(mysql_error());
$month = mysql_fetch_array( $result );

$data1y=$expAmounts1;

if ($timeLine == 'prev3')
{				 
  $result2 = mysql_query($expTypeQuery2) or die(mysql_error());
  $rowCount = 0;
  while($row2 = mysql_fetch_array( $result2 ))
  {
	$expTypes[$rowCount] = $row2[0];
	$expAmounts2[$rowCount] = $row2[1];

	$testExpAmounts2 .= $row2[1];
	
    $rowCount++;

  }  
  $data2y=$expAmounts2;
  
  $result3 = mysql_query($expTypeQuery3) or die(mysql_error());
   $rowCount = 0;
  while($row3 = mysql_fetch_array( $result3 ))
  {
	$expTypes[$rowCount] = $row3[0];
	//echo $row[0];
	$expAmounts3[$rowCount] = $row3[1];
	//echo $row[1];

    $rowCount++;

  }  
  $data3y=$expAmounts3;
}

/*$data1y =array(12,8, 19,3,10 ,5); 
$data2y =array(12,8, 19,3,10 ,5); 
$data3y =array(12,8, 19,3,10 ,5); */

$datax=$expTypes;
if($groupType == 'EXP')
{
  $xsize = 800;
  $ysize = 400;
}
else
{
  $xsize = 1000;
  $ysize = 600;
}
if($graphStyle =='BAR')
{
  $graph = new Graph($xsize,$ysize,"auto");
  $graph->img->SetMargin(60,50,30,100);

  // Set up the title tab for the graph
  if ($groupType == 'EXP')
  {
    //$graph->title->Set('Grouping by Expense Types for '.$month[0]);
	$graph->title->Set($expTypeQuery1);
	$graph->title->Set($testExpAmounts2);
	

  }
  else
  {
    $graph->title->Set('Grouping by Merchants for '.$month[0]);
  }
  $graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,10);

  $graph->SetScale("textlin");
  $graph->SetMarginColor("lightblue");

  $graph->SetShadow();

  $graph->title->SetFont(FF_VERDANA,FS_NORMAL,12);
  $graph->title->SetColor("darkred");

  // Setup font for axis
  $graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
  $graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);

  // Show 0 label on Y-axis (default is not to show)
  $graph->yscale->ticks->SupressZeroLabel(false);

  // Setup X-axis labels
  $graph->xaxis->SetTickLabels($datax);
  $graph->xaxis->SetLabelAngle(50);



  // Create the bar pot
  $b1plot = new BarPlot($data1y);
  $b1plot->SetWidth(0.6);

  // Setup color for gradient fill style
  $b1plot->SetFillGradient("navy","#EEEEEE",GRAD_LEFT_REFLECTION);

  // Set color for the frame of each bar
  $b1plot->SetColor("green");

  $b1plot->value->Show();
  //$b1plot->value->SetAngle(45);

  $b1plot->value->SetFont(FF_ARIAL,FS_BOLD);
  
  if ($timeLine == 'prev3') 
  {
    $b2plot = new BarPlot($data2y);
	$b2plot->SetColor("blue");
	$b2plot->SetFillGradient("darkgreen","#EEEEEE",GRAD_LEFT_REFLECTION);
	$b2plot->value->Show();
	//$b2plot->value->SetAngle(45);


    $b3plot = new BarPlot($data3y);
	$b3plot->SetColor("brown");
	$b3plot->SetFillGradient("pink","#EEEEEE",GRAD_LEFT_REFLECTION);
	$b3plot->value->Show();
	//$b3plot->value->SetAngle(45);
	
    $gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
	$graph->Add($gbplot);
  }  

  else 
  {
    $graph->Add($b1plot);
  } 	
}
if($graphStyle =='PIE')
{
  $graph = new PieGraph(800,400,"auto");
  $graph->SetShadow();
  $graph->title->Set('Grouping by Expense Types for '.$month[0]);
  $graph->title->SetFont(FF_FONT1,FS_BOLD);

  $p1 = new PiePlot3D($data1y);
  $p1->SetSize(.3);
  $p1->SetCenter(0.45);
  $p1->SetStartAngle(20);
  $p1->SetAngle(45);

  $p1->SetLegends($datax);

  $p1->value->SetFont(FF_FONT1,FS_BOLD);
  $p1->value->SetColor("darkred");
  $p1->SetLabelType(PIE_VALUE_PER);

  $graph->Add($p1);
}
if($graphStyle =='LINE')
{
  $graph = new Graph(800,400,"auto");
  $graph->img->SetMargin(40,80,40,80);
  $graph->SetScale("textlin");

  // Adjust the margin
  //$graph->img->SetMargin(40,20,20,20);
  $graph->SetShadow();

  // Create the linear plot
  $lineplot=new LinePlot($data1y);
  $lineplot->mark->SetType(MARK_UTRIANGLE);
  $lineplot->value->show();

  // Add the plot to the graph
  $graph->Add($lineplot);

  $graph->title->Set('Grouping by Expense Types for '.$month[0]);

  $graph->title->SetFont(FF_FONT1,FS_BOLD);
  $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
  $graph->xaxis->SetTickLabels($datax);
  $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
  $graph->xaxis->SetLabelAngle(45);

  $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

  $lineplot->SetColor("blue");
  $lineplot->SetWeight(2);
}

// Finally send the graph to the browser
$graph->Stroke();
?>
