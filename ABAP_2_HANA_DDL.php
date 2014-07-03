<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php

if (isset($_POST['tabName']))
{
  $tabName = $_POST['tabName'];
}

if (isset($_POST['storage_type']))
{
  if ($_POST['storage_type'] == 1)
  {
     $storageType = 'COLUMN';
  }
  else if ($_POST['storage_type'] == 2)
  {
     $storageType = '';
  }
 
}

if (isset($_POST['pk_cols']))
{
  $pkList = $_POST['pk_cols'];
}
  
function csv_explode($str, $delim = ' ', $qual = "\"")
{
  $len = strlen($str);
  $inside = false;
  $word = '';
  $commaSkip = '\'';
  for ($i = 0; $i < $len; ++$i)
  {
    if ($str[$i]==$delim && !$inside)
    {
      $out[] = $word;
      $word = '';
    }
    else if ($inside && $str[$i]==$qual && ($i<$len && $str[$i+1]==$qual) )
    {
      $word .= $qual;
      ++$i;
    }
    else if ($str[$i] == $qual)
    {
      $inside = !$inside;
    }
    else
    {

      if($str[$i] =='$' && $str[$i-1] =='(' )
      {
        $word .= '-';
      }
      elseif($str[$i] =='$' && $str[$i-1] !='(' )
      {
        $word .= '+';
      }
      if($str[$i]!=$commaSkip && $str[$i]!= '$' && $str[$i]!= '(' && $str[$i]!= ')')
      {
        $word .= $str[$i];
      }
    }
  }
  $out[] = $word;
  return $out;
}

if (isset($_FILES["file"]))
{
  if ($_FILES["file"]["error"] > 0)
  {
    echo "Return Code: ".$_FILES["file"]["error"] . "<br/>";
  }
  else
  {
    //echo "Upload: ".$_FILES["file"]["name"]."<br />";
    //echo "Type: ".$_FILES["file"]["type"]."<br />";
   // echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br />";
    //echo "Temp file: ".$_FILES["file"]["tmp_name"]."<br />";

    //if (file_exists("Uploaded/".$_FILES["file"]["name"]))
    //{
      //echo $_FILES["file"]["name"]." already exists. ";
    //}
  //else
  //{
    move_uploaded_file($_FILES["file"]["tmp_name"],"Uploaded/".$_FILES["file"]["name"]);
    //echo "Stored in: "."Uploaded ".$_FILES["file"]["name"];
    $fc=file("Uploaded/".$_FILES["file"]["name"]);

    //echo $fc;

    $countOfLines = count($fc);
	//echo $countOfLines;
    //loop through array using foreach
		
	$loopCounter = 1;
	echo "SQL generator for creating tables";
	
    echo "<br />";

    
    echo "<br />";
	
	echo "DROP table ";
	echo $tabName.";";
    echo "<br />";	
	echo "CREATE ".$storageType." table ";
	echo $tabName."(";
	echo "<br>";
	echo "<br>";
    foreach($fc as $line)
    {
      
	  list($column_name,$index,$data_type,$length) = csv_explode($line);
      echo $column_name."  ";
      echo $data_type."(  ";
      echo $length.")";
	  
	  if ($loopCounter < $countOfLines )
	  {
	    echo ",";
	  } 
	  $loopCounter++;
      echo "<br />";
    }
    echo ");";
    echo "<br />";
	echo "<br />";

  //}
  
  if (isset($_POST['pk_cols']))
  {
	echo "alter table ".$tabName ." add PRIMARY KEY(".$pkList.");";
  }
}

}
?>

<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<label for="tabName">Table Name(schema.table): </label>
<input type="text" name="tabName" id="tabName" />
<br/>
<br/>

<label>Select storage type :</label>  
	<select name="storage_type">
       <option value="1">  COLUMN</option>
       <option value="2">  ROW</option>
    </select>
<br/>
<br/>	
<label for="pk_cols">Primary Key column(s): </label>
<input type="text" name="pk_cols" id="pk_cols" />
<br/>
<br/>


<label for="file">Filename:</label>
<input type="file" name="file" id="file" />

<br/>
<input type="submit" name="submit" value="Submit" />

</form>


</body>

</html>