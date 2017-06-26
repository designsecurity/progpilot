<?php

require_once './vendor/autoload.php';

try {

	$files = array(
	
			"./tests/negative/missing_argument_func.php",
			"./tests/negative/undefined_class.php", 
			"./tests/negative/undefined_func.php", 
			"./tests/negative/undefined_method.php"
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
	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
