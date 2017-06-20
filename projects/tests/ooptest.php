<?php

require_once './vendor/autoload.php';

try {

	$files = array(

			"./tests/oop/simple1.php",
			"./tests/oop/simple2.php", 
			"./tests/oop/simple3.php", 
			"./tests/oop/simple4.php", 
			"./tests/oop/simple5.php", 
			"./tests/oop/simple6.php", 
			"./tests/oop/simple7.php",
			"./tests/oop/simple8.php",
			"./tests/oop/simple9.php",
			"./tests/oop/simple10.php",
			"./tests/oop/simple11.php"
		      );

	foreach($files as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;

		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");

		$analyzer->set_file($file);
		$analyzer->run($context);

		$results = $context->get_results();
		$outputjson = array('results' => $results); 

		$parsed_json = $outputjson["results"];
		echo "test $file ";

		if(isset($parsed_json[0]) && count($parsed_json) == 1)
		{
			$vuln = $parsed_json[0];

			if($file == "./tests/oop/simple1.php")
			{
				$tempsource = array("boum2");
				$tempsource_line = array("6");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple2.php")
			{
				$tempsource = array("boum2");
				$tempsource_line = array("6");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple3.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple4.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("10");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple5.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("15");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple6.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("15");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple7.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple8.php")
			{
				$tempsource = array("boum2");
				$tempsource_line = array("6");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple9.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("0");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple10.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/oop/simple11.php")
			{
				$tempsource = array("boum1");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
		}
		else
		{
			echo "[$file] test result ko\n";
			var_dump($parsed_json);
		}

	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
