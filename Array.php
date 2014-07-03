<html> 
<head></head>
<body> 

<?php 
// check for submit 
if (!isset($_POST['submit'])) { 
    // and display form 
    ?> 

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
    <input type="checkbox" name="artist[]" value="Bon Jovi">Bon Jovi 
    <input type="checkbox" name="artist[]" value="N'Sync">N'Sync 
    <input type="checkbox" name="artist[]" value="Boyzone">Boyzone 
    <input type="checkbox" name="artist[]" value="Britney Spears">Britney Spears 
    <input type="checkbox" name="artist[]" value="Jethro Tull">Jethro Tull 
    <input type="checkbox" name="artist[]" value="Crosby, Stills & Nash">Crosby, Stills & Nash 
    <input type="submit" name="submit" value="Select"> 
    </form> 

<?php 
    } 
else { 
    // or display the selected artists 
    // use a foreach loop to read and display array elements 
    if (is_array($_POST['artist'])) { 
        echo 'You selected: <br />'; 
        foreach ($_POST['artist'] as $a) { 
           echo "<i>$a</i><br />"; 
            } 
        } 
    else { 
        echo 'Nothing selected'; 
    } 
} 
?> 

</body> 
</html>