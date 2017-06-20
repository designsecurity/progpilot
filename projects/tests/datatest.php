<?php

require_once './vendor/autoload.php';

try {

	$files = array(

			"./tests/data/sink1.php",
			"./tests/data/sink2.php",
			"./tests/data/sink3.php",
			"./tests/data/sink4.php",
			"./tests/data/source1.php",
			"./tests/data/source2.php",
			"./tests/data/sanitizer1.php",
			"./tests/data/sanitizer2.php",
			"./tests/data/sanitizer3.php",
			"./tests/data/sanitizer4.php"
		      );

	foreach($files as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;

		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");

		$analyzer->set_file($file);

		try 
		{
			$analyzer->run($context);
		}
		catch (Exception $e) 
		{
			echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}

		$results = $context->get_results();
		$outputjson = array('results' => $results); 

		$parsed_json = $outputjson["results"];
		echo "test $file ";

		if(isset($parsed_json[0]) && count($parsed_json) == 1)
		{
			$vuln = $parsed_json[0];

			if($file == "./tests/data/sink1.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sink2.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sink3.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sink4.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/source1.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/source2.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sanitizer1.php")
			{
				$tempsource = array("var7safe");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sanitizer2.php")
			{
				$tempsource = array("var7safe3");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sanitizer3.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/data/sanitizer4.php")
			{
				$tempsource = array("var7safe3");
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
