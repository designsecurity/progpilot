<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

$framework->add_testbasis("./tests/includes/simple5.php");
$framework->add_output("./tests/includes/simple5.php", array("\$var1"));
$framework->add_output("./tests/includes/simple5.php", array("3"));
$framework->add_output("./tests/includes/simple5.php", "xss");

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->set_sources("./data/sources.json");
$context->inputs->set_sinks("./data/sinks.json");
$context->inputs->set_sanitizers("./data/sanitizers.json");
$context->inputs->set_validators("./data/validators.json");
$context->inputs->set_file("./tests/includes/simple5.php");

$context->outputs->resolve_includes_file("resolve_includes.json");
$context->outputs->resolve_includes(true);

//$context->inputs->set_includes("./tests/includes/resolved_includes_simple5.txt");      
		
$analyzer->run($context);
		
?> 
