<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

try {
	$context = new \progpilot\Context;
	$analyzer = new \progpilot\Analyzer;

	$context->inputs->set_sources("./data/sources.json");
	$context->inputs->set_sinks("./data/sinks.json");
	$context->inputs->set_sanitizers("./data/sanitizers.json");
	$context->inputs->set_validators("./data/validators.json");
	$context->inputs->set_include_files("include_files.json");

	try 
	{
		$analyzer->run($context);
	}
	catch (Exception $e) 
	{
		echo 'Exception : ',  $e->getMessage(), "\n";
	}

	$results = $context->outputs->get_results();
	$outputjson = array('results' => $results); 
	$parsed_json = $outputjson["results"];

	var_dump($parsed_json);

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
