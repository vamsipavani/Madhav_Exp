<html>
<head>

 <title>Test CSV</title>

<h2>Test CSV</h2>
</head>
<body>

<?php

//load file into $fc array

$fc=file("D:\per\expenses\jan_feb_mc.csv");
$countOfExpenses = count($fc);
//loop through array using foreach

$keyNumber = 1;

$dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
mysql_select_db("analysis") or die(mysql_error());
echo "Connected to Database";
echo "<br />";

echo "Begin data loading";
echo "<br />";
foreach($fc as $line)
{
list($trans_date,$amount,$merchant,$exp_type) = csv_explode($line);

echo $trans_date."  ";
echo $amount."  ";
//echo $trans_number."  ";
echo $merchant."  ";
//echo $address.'';
echo $exp_type."  ";
echo "<br />";
if (!$keyNumber==0)
{
  mysql_query("insert into expenses(exp_date,exp_desc, merchant_address,exp_amount,exp_type, user_id, cycle_id)
  values(STR_TO_DATE('$trans_date','%m/%d/%Y'),'','$merchant','$amount',SUBSTRING('$exp_type',1,4),1,1)") or die(mysql_error());

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
mysql_close($dbhandle);

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

?>

</body>
</html>

