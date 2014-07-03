<html>
<head></head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
Enter number of rows <input name="rows" type="text" size="4"> and columns <input name="columns" type="text" size="4"> <input type="submit" name="submit" value="Draw Table">
</form>

<?php

if (isset($_POST['submit'])) {
    echo "<table width = 90% border = '1' cellspacing = '5' cellpadding = '0'>";
    // set variables from form input
    $rows = $_POST['rows'];
    $columns = $_POST['columns'];
    $columnCount = 0;
    // loop to create rows
    for ($r = 1; $r <= $rows; $r++) {
        echo "<tr>";
        // loop to create columns
        $c=1;

        do{
            echo "<td>";

            echo $columnCount+$c;
            echo "</td>\n";
            $c++;
        } while ($c <= $columns);
        $columnCount = $columnCount + ($c-1);
        echo "</tr>\n";
    }
    echo "</table>\n";
}



// define an array
$fruits = array('red' => 'apple', 'yellow' => 'banana', 'purple' => 'plum', 'green' => 'grape');
print_r($fruits);


?>

</body>
</html>


