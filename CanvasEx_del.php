<?php
// $Id: canvasex01.php,v 1.3 2002/10/23 08:17:23 aditus Exp $
include ("D:\Apache224\htdocs\PHPGraphics\src\jpgraph.php");
include ("D:\Apache224\htdocs\PHPGraphics\src\jpgraph_canvas.php");
include ("D:\Apache224\htdocs\PHPGraphics\src\jpgraph_canvtools.php");

// Setup a basic canvas we can work
$g = new CanvasGraph( 400,50,'auto' );
$g->SetMargin( 5,5,5 ,5);
//$g->SetShadow();
$g->SetMarginColor( "navy");
$g->SetBackgroundGradient();

// We need to stroke the plotarea and margin before we add the
// text since we otherwise would overwrite the text.
$g->InitFrame();

// Draw a text box in the middle
$txt="This is a TEXT!!!";
$t = new CanvasRectangleText();
$t->SetFont(FF_ARIAL,FS_NORMAL,14);
$t->SetFillColor('navy');
$t->SetFontColor('yellow');

$t->SetFillColor('blue');
$t->SetFontColor('white');
$t->SetFont(FF_ARIAL,FS_BOLD,20);
$t->Set("Expenses Analyzer",10,10,10);

// How should the text box interpret the coordinates?
//$t->Align( 'center','top');

// How should the paragraph be aligned?
//$t->ParagraphAlign( 'center');

// Add a box around the text, white fill, black border and gray shadow
//$t->SetBox( "white", "black","gray");

// Stroke the text
$t->Stroke( $g->img);

// Stroke the graph
$g->Stroke();

?>



$t->Stroke($g->img,$scale);