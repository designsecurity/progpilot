<?php

require_once './vendor/autoload.php';

$file = "./tests/PHP-Vulnerability-test-suite/IDOR/CWE_862_Fopen/unsafe/CWE_862_Fopen__GET__func_preg_replace__fopen.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->set_sources("../uptodate_data/sources.json");
$context->inputs->set_sinks("../uptodate_data/sinks.json");
$context->inputs->set_sanitizers("../uptodate_data/sanitizers.json");
$context->inputs->set_validators("../uptodate_data/validators.json");
$context->inputs->set_file($file);

$analyzer->run($context);
$results = $context->outputs->get_results();

var_dump($results);

?>	 
