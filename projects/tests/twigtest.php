<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

try {

	
		
	$framework = new framework_test;
			
	$framework->add_testbasis("./tests/twig/twig1.php");
	$framework->add_output("./tests/twig/twig1.php", array("boum2"));
	$framework->add_output("./tests/twig/twig1.php", array("3"));
	$framework->add_output("./tests/twig/twig1.php", "xss");

	foreach($framework->get_testbasis() as $file)
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
			
			$basis_outputs = [
				$vuln['source'],
				$vuln['source_line'],
				$vuln['vuln_name']];
				
			if($framework->check_outputs($file, $basis_outputs))
			{
				echo "[$file] test result ok\n";
			}
			else
			{
				echo "[$file] test result ko\n";
				var_dump($vuln);
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
