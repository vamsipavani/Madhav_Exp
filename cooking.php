<html> 
<head></head>
<body> 

<?php 
// get form selection 
$day = $_REQUEST['day']; 
// check value and select appropriate item 
if ($day == 1) { 
    $special = 'Chicken in oyster sauce'; 
    } 
elseif ($day == 2) { 
    $special = 'French onion soup'; 
    } 
elseif ($day == 3) { 
    $special = 'Pork chops with mashed potatoes and green salad'; 
    } 
else { 
    $special = 'Fish and chips'; 
} 
?> 

<h2>Today's special is:</h2> 
<?php echo $special; ?> 
</body> 
</html> 

