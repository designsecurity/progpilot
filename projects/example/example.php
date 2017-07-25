<?php

require_once './vendor/autoload.php';

$file = "example1.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->set_sources("./data/sources.json");
$context->inputs->set_sinks("./data/sinks.json");
$context->inputs->set_sanitizers("./data/sanitizers.json");
$context->inputs->set_validators("./data/validators.json");
$context->inputs->set_file($file);

$analyzer->run($context);
$results = $context->outputs->get_results();

var_dump($results);

?>	 
