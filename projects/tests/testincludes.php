<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("./tests/includes/simple5.php");

$context->outputs->resolveIncludesFile("resolve_includes.json");
$context->outputs->resolveIncludes(true);

//$context->inputs->set_includes("./tests/includes/resolved_includes_simple5.txt");

$analyzer->run($context);
