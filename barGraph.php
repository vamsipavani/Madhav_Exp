<?php
//Querying the database to get poll results

//connection to the database
$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());

//select a database to work with
$selected = mysql_select_db("analysis",$dbhandle)
  or die("Could not select examples");

//execute the SQL query and return records
$result = mysql_query("SELECT * FROM results");

$num_poller = mysql_num_rows($result);

$total_votes = 0;

//fetch the data from the database
while ($row = mysql_fetch_array($result)) {

$total_votes += $row{'num_votes'};  //calculating total number of votes
}

//nulling the pointer $result
mysql_data_seek($result,0);

//close the connection
mysql_close($dbhandle);

$font = 'arial';

//Set starting point for drawing
$y = 50;

//Specify constant values
$width = 700; //Image width in pixels
$bar_height = 20; //Bars height
$height = $num_poller * $bar_height * 1.5 + 70; //Calculating image height
$bar_unit = ($width - 400) / 100; //Distance on the bar chart standing for 1 unit

//Create the image resource
$image = ImageCreate($width, $height);

//We are making four colors, white, black, blue and red
$white = ImageColorAllocate($image, 255, 255, 255);
$black = ImageColorAllocate($image, 0, 0, 0);
$red   = ImageColorAllocate($image, 255, 0, 0);
$blue  = imagecolorallocate($image,0,0,255);

//Create image background
ImageFill($image,$width,$height,$white);
//Draw background shape
ImageRectangle($image, 0, 0, $width-1, $height-1, $blue);
//Output header
ImageTTFText($image, 16, 0, $width/3 + 50, $y - 20, $black, $font, 'Poll Results');

while ($row = mysql_fetch_object($result)) {
  if ($total_votes > 0)
    $percent = intval(round(($row->num_votes/$total_votes)*100));
  else
    $percent = 0;

//Output header for a particular value
ImageTTFText($image,12,0,10, $y+($bar_height/2), $black, $font, $row->book_type);
//Output percentage for a particular value
ImageTTFText($image, 12, 0, 170, $y + ($bar_height/2),$red,$font,$percent.'%');

$bar_length = $percent * $bar_unit;

//Draw a shape that corresponds to 100%
ImageRectangle($image, $bar_length+221, $y-2, (220+(100*$bar_unit)), $y+$bar_height, $black);
//Output a bar for a particular value
ImageFilledRectangle($image,220,$y-2,220+$bar_length, $y+$bar_height, $blue);
//Output the number of votes
ImageTTFText($image, 12, 0, 250+100*$bar_unit, $y+($bar_height/2), $black, $font, $row->num_votes.' votes cast.');

//Going down to the next bar
$y = $y + ($bar_height * 1.5);

}

//Tell the browser what kind of file is come in
header("Content-Type: image/jpeg");

//Output the newly created image in jpeg format
ImageJpeg($image);

//Free up resources
ImageDestroy($image);
?>