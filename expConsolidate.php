<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php

include_once("expCommonHeader.php");
function csv_explode($str, $delim = ',', $qual = "\"")
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
//get month and year of the billing cycle
if (isset($_POST["billing_month"])){

  $mth = $_POST['billing_month'];
}

if (isset($_POST["billing_year"])){
  $yr = $_POST['billing_year'];
} 


if (isset($_FILES["file"]))
{
  if ($_FILES["file"]["error"] > 0)
  {
    echo "Return Code: ".$_FILES["file"]["error"] . "<br/>";
  }
  else
  {
    echo "Upload: ".$_FILES["file"]["name"]."<br />";
    echo "Type: ".$_FILES["file"]["type"]."<br />";
    echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br />";
    echo "Temp file: ".$_FILES["file"]["tmp_name"]."<br />";

    if (file_exists("Uploaded/".$_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"]." already exists. ";
  }
  else
  {
    move_uploaded_file($_FILES["file"]["tmp_name"],"Uploaded/".$_FILES["file"]["name"]);
    echo "Stored in: "."Uploaded ".$_FILES["file"]["name"];
    $fc=file("Uploaded/".$_FILES["file"]["name"]);

    echo $fc;

    $countOfExpenses = count($fc);
    //loop through array using foreach

    $keyNumber = 1;
    $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
    mysql_select_db("analysis") or die(mysql_error());
    echo "Connected to Database";
    echo "<br />";

    echo "Begin data loading";
    echo "<br />";
    $getMaxCycleId = 'select max(cycle_id) from expenses';

    $resultMaxCycleId = mysql_query($getMaxCycleId) or die(mysql_error());
    while($row = mysql_fetch_array( $resultMaxCycleId ))
    {
      $maxCycleId = $row[0];
      $maxCycleId++;
    }
    echo "Cycle_id is ".$maxCycleId;

    foreach($fc as $line)
    {
      list($trans_date,$amount,$merchant,$exp_type) = csv_explode($line);
      echo $trans_date."  ";
      echo $amount."  ";
      echo $merchant."  ";
      echo $exp_type."  ";
      echo "<br />";

      $getCatId = "select max(cat_id) from exp_merchants where mer_name = '".substr($merchant,0,8)."'";

      //"Update expenses set cat_id = '".$expTypeSelected."' where exp_id = ".$value;

      echo $getCatId ;
      $resultGetCatId = mysql_query($getCatId) or die(mysql_error());
      while($row = mysql_fetch_array( $resultGetCatId ))
      {
        $maxCatId = $row[0];
        if($maxCatId == NULL)
        {
          $maxCatId = 12;
          $cat_found = 'N';
        }
      }
      echo "Cat_id is ".$maxCatId;

      $expInsert = "insert into expenses(exp_date,
                                         exp_desc,
                                         merchant_address,
                                         exp_amount,
                                         exp_type,
                                         cycle_id,
                                         exp_tag,
                                         cat_id,
                                         user_id,
										 billing_year,
										 billing_month)
                    values(STR_TO_DATE('$trans_date','%m/%d/%Y'),
                           '',
                           '$merchant',
                           $amount,
                           SUBSTRING('$exp_type',1,4),
                           $maxCycleId,
                           'r',
                           '$maxCatId',
                           1          ,
							$yr,
							$mth)";
      echo $expInsert;

      if (!$keyNumber==0)
      {
        mysql_query($expInsert) or die(mysql_error());
      }

      $keyNumber++;
    }
    echo "Done data loading";
    echo "<br />";
    echo "Loaded ".$keyNumber." records into the database";

    if ($keyNumber < $countOfExpenses)
    {
      echo "Not all rows loaded. Graphs might not reflect accurate information";

    }
  }
}
mysql_close($dbhandle);

}
?>

<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<p>
<label>Select a billing cycle :</label>  
	<select name="billing_month">
       <option value="1">  January-February</option>
       <option value="2">  February-March</option>
       <option value="3">  March-April</option>
	   <option value="4">  April-May</option>
	   <option value="5">  May-June</option>
	   <option value="6">  June-July</option>
	   <option value="7">  July-August</option>
	   <option value="8">  August-September</option>
	   <option value="9">  September-October</option>
	   <option value="10"> October-November</option>
	   <option value="11"> November-December</option>
	   <option value="12"> December-January</option>
    </select>
	
	<select name="billing_year">
	   <option value="2005"> 2005</option>
	   <option value="2006"> 2006</option>
	   <option value="2007"> 2007</option>
	   <option value="2008"> 2008</option>
	   <option value="2009"> 2009</option>
	   <option value="2010"> 2010</option>
	   <option value="2011"> 2011</option>
    </select>	
</p>	
<br />
<p>
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
</p>
<br/>
<input type="submit" name="submit" value="Submit" />

</form>


</body>

</html>