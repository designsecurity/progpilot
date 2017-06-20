<?php

require_once './vendor/autoload.php';

try {

	$files = array(
			"./tests/twig/twig1.php"
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

			if($file == "./tests/twig/twig1.php")
			{
				$tempsource = array("boum2");
				$tempsource_line = array("3");
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
