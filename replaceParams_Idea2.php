/*if ($handle = opendir('C:/SSA/FilesToClean')) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    /* Loop over the directory. */
    while (false !== ($file = readdir($handle))) 
	{
		$i=0;
		//dont look at .. and . in directory, linux and windows 
		if($file !== "." && $file !== "..")
		{ 
			//get content of file into string 
			$fileContent = Array();
			$fileContent = file($file); 

			while($i < count($paramNamesGivenSplit)){

				$searchValues = array('/$paramNamesGivenSplit[$i]/','/$paramNamesGivenSplit2[$i]/') ;
				$replace = $paramNamesRequired[$i];
				
				echo "Searching for ".$paramNamesGivenSplit[$i]." and ".$paramNamesGivenSplit2[$i]." and replacing them with ".$paramNamesRequired[$i]."<br>";
				echo "Filename is ".$file."<br><br>";
				foreach ($fileContent as $line_num => $line) 
				{
					$text = preg_replace($searchValues, $replace, $line);
					if ($line != $text) {
						echo "Match found and text changed to ".$text ."at line number ".$line_num;
					}
					echo "<br>";
				}
				$i++;
			}
			//fclose($handle); 
		}
    }
}*/
