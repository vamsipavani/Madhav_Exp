<html> 
<head></head>
<body> 

<?php 
// read recipe file into array 
$data = file('D:\Apache224\htdocs\SpanishOmlette.txt'); 
/* first line contains title: read it into variable */ 
$title = $data[0]; 
// remove first line from array 
array_shift($data); 
?> 

<h2><?php echo $title; ?></h2> 

<?php 
/* iterate over content and print it */ 
foreach ($data as $line) { 
    echo nl2br($line); 
} 
?> 

</body> 
</html> 