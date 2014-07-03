<?php

include ("PHPGraphics/src/jpgraph.php");
include ("PHPGraphics/src/jpgraph_canvas.php");
include ("PHPGraphics/src/jpgraph_canvtools.php");

// Scale we are using
$ymax = 5;
$xmax=5;

$textStyle = $_GET['textType'];

// Setup the basic canvas
$g = new CanvasGraph( 500,100,'auto' );
//$g->SetMargin(2,2,2,2);
//$g->SetMarginColor("yellow");
//$g->InitFrame();

// ... and a scale
$scale = new CanvasScale($g);
$scale->Set(0,$xmax,0,$ymax);

// ... we need shape since we want the indented rectangle
$shape = new Shape($g,$scale);
$shape->SetColor('white');

// ... basic parameters for the overall image
$l = 0.5;        // Left margin
$r = 0;    // Row number to start the lowest line on
$width =4;    // Total width

$t = new CanvasRectangleText();
$t->SetFont(FF_ARIAL,FS_NORMAL,14);
$t->SetFillColor('navy');
$t->SetFontColor('yellow');

$r = 0.5; $h=3;
$t->SetFillColor('blue');
$t->SetFontColor('white');
$t->SetFont(FF_ARIAL,FS_BOLD,20);
$t->Set("Expenses Analyzer",$l,$r,$width,$h);
$t->Stroke($g->img,$scale);

// .. and stream it all back
$g->Stroke();

?>