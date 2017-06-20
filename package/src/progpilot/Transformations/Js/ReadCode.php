<?php

$handle = fopen("file.txt", "r");

if($handle)
{
	while(!feof($handle))
	{
		$buffer = fgets($handle);
		echo $buffer;
	}

	fclose($handle);
}

?>
