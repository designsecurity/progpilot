<?php

require_once './vendor/autoload.php';

try {

	$file = "./tests/graphs/functionsgraph1.php";
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;
		
    $context->inputs->set_file($file);
    $analyzer->run($context);
    
	$graphcfg_json = $context->outputs->get_cfg();
	$graphcallgraph_json = $context->outputs->get_callgraph();
	
	var_dump($graphcfg_json);
	var_dump($graphcallgraph_json);

} catch (\RuntimeException $e) {
    echo 'Exception : ',  $e->getMessage(), "\n";
}

?>
