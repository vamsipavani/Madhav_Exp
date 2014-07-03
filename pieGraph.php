<?php

include ("D:\Apache224\htdocs\PHPGraphics\src\jpgraph.php");
include ("D:\Apache224\htdocs\PHPGraphics\src\jpgraph_line.php");


$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());

$rowCount = 0;
$expTypeQuery = 'SELECT ltrim(exp_type),sum(exp_amount) from expenses group by exp_type';

$result = mysql_query($expTypeQuery) or die(mysql_error());

$expTypes;
$expAmounts;

while($row = mysql_fetch_array( $result ))
{
	$expTypes[$rowCount] = $row[0];
	//echo $row[0];
	$expAmounts[$rowCount] = $row[1];
	//echo $row[1];

$rowCount++;

}

$datay=$expAmounts;
$datax=$expTypes;

 /*  $graph = new Graph(800,400,"auto");
  $graph->img->SetMargin(60,20,30,50);

  // Set up the title tab for the graph
  $graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,13);

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
  //$graph->xaxis->SetLabelMargin(300);


  // Create the bar pot
  $bplot = new BarPlot($datay);


  $bplot->SetWidth(0.6);

  // Setup color for gradient fill style
  $bplot->SetFillGradient("navy","#EEEEEE",GRAD_LEFT_REFLECTION);

  // Set color for the frame of each bar
  $bplot->SetColor("green");

  $bplot->value->Show();
  $bplot->value->SetFont(FF_ARIAL,FS_BOLD);

  $graph->Add($bplot);*/

  /*$graph = new PieGraph(600,600,"auto");
  $graph->SetShadow();
  $graph->title->Set("MySQL & JpGraph");
  $graph->title->SetFont(FF_FONT1,FS_BOLD);

  $p1 = new PiePlot3D($datay);
  $p1->SetSize(.3);
  $p1->SetCenter(0.45);
  $p1->SetStartAngle(20);
  $p1->SetAngle(45);

  $p1->SetLegends($datax);

  $p1->value->SetFont(FF_FONT1,FS_BOLD);
  $p1->value->SetColor("darkred");
  $p1->SetLabelType(PIE_VALUE_PER);

  $graph->Add($p1);*/

// Create the graph. These two calls are always required
$graph = new Graph(800,400,"auto");
$graph->img->SetMargin(40,80,40,80);
$graph->SetScale("textlin");

// Adjust the margin
//$graph->img->SetMargin(40,20,20,20);
$graph->SetShadow();

// Create the linear plot
$lineplot=new LinePlot($datay);
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->value->show();

// Add the plot to the graph
$graph->Add($lineplot);

$graph->title->Set("Displaying the values");


$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->xaxis->SetLabelAngle(45);

$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

  // Finally send the graph to the browser
  $graph->Stroke();
?>

