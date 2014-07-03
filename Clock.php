<?php
header("Content-type: image/png");
$time = strftime("%I:%M:%S", time());
$timearray = explode(':',$time);
$hour = (((int)$timearray[0]) * 60) + (int)$timearray[1];
$minute = (int)$timearray[1];
$second = (int)$timearray[2];
if($hour != 0) {
    $hourdegree = ((360 / (720 / $hour)) - 90) % 360;
    if($hourdegree < 0) { $hourdegree = 360 + $hourdegree; }
} else {
    $hourdegree = 270;
}
if($minute != 0) {
    $minutedegree = ((360 / (60 / $minute)) - 90) % 360;
    if($minutedegree < 0) { $minutedegree = 360 + $minutedegree; }
} else {
    $minutedegree = 270;
}
if($second != 0) {
    $seconddegree = ((360 / (60 / $second)) - 90) % 360;
    if($seconddegree < 0) { $seconddegree = 360 + $seconddegree; }
} else {
    $seconddegree = 270;
}

$image = @imagecreate(100,100) or die("Cannot Initialize new GD image stream");
$maroon = ImageColorAllocate($image,123,9,60);
$white = ImageColorAllocate($image,255,255,255);
$black = ImageColorAllocate($image,0,0,0);

ImageFilledRectangle($image,0,0,99,99,$white);
ImageFilledEllipse($image,49,49,100,100,$black);
ImageFilledEllipse($image,49,49,95,95,$maroon);
ImageFilledEllipse($image,49,49,75,75,$white);
ImageFilledEllipse($image,49,49,5,5,$maroon);
ImageFilledArc($image,49,49,50,50,$hourdegree-4,$hourdegree+4,
$maroon,IMG_ARC_PIE);
ImageFilledArc($image,49,49,65,65,$minutedegree-3,$minutedegree+3,
$maroon,IMG_ARC_PIE);
ImageFilledArc($image,49,49,70,70,$seconddegree-2,$seconddegree+2,
$black,IMG_ARC_PIE);

ImageColorTransparent($image,$white);

ImageTTFText ($image, 8, 0, 44, 11, $white,
"/home/mjw21/www/images/arial.ttf","12");
ImageTTFText ($image, 8, 0, 89, 53, $white,
"/home/mjw21/www/images/arial.ttf","3");
ImageTTFText ($image, 8, 0, 47, 96, $white,
"/home/mjw21/www/images/arial.ttf","6");
ImageTTFText ($image, 8, 0, 5, 53, $white,
"/home/mjw21/www/images/arial.ttf","9");

imagePNG($image);
imagedestroy($image);
?>
