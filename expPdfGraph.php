How can I use an image in a dynamically created PDF?
You can do this in two ways, you can either stroke the image created with the library directly to a file where it can be used with Your PDF library of choice. For example, using FPDF (www.fpdf.org) the Image() functoin would have to be used to read an image from the filesystem. 
If You are using the PDF library (APIs included in the PHP distribution but the library itself might require a license depending on Your usage.) you can avoid the storage of the file by getting the image handler for the image directly and use it with PDF. 

With the PDF library you must first open the in memory image with a call to pdf_open_memory_image($pdf, $im). The following script places an image from JpGraph directly into a PDF page that is returned when running this script. 


<?php

$graph = new Graph(...);

// Code to create the graph
// .........................
// .........................

// Put the image in a PDF page
$im = $graph->Stroke(_IMG_HANDLER);

$pdf = pdf_new();
pdf_open_file($pdf, '');

// Convert the GD image to somehing the
// PDFlibrary knows how to handle
$pimg = pdf_open_memory_image($pdf, $im);

pdf_begin_page($pdf, 595, 842);
pdf_add_outline($pdf, 'Page 1');
pdf_place_image($pdf, $pimg, 0, 500, 1);
pdf_close_image($pdf, $pimg);
pdf_end_page($pdf);
pdf_close($pdf);

$buf = pdf_get_buffer($pdf);
$len = strlen($buf);

// Send PDF mime headers
header('Content-type: application/pdf');
header("Content-Length: $len");
header("Content-Disposition: inline; filename=foo.pdf");

// Send the content of the PDF file
echo $buf;

// .. and clean up
pdf_delete($pdf);

?>

