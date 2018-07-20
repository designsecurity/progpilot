<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setSources("../../package/src/uptodate_data/sources.json");
$context->inputs->setSinks("../../package/src/uptodate_data/sinks.json");
$context->inputs->setSanitizers("../../package/src/uptodate_data/sanitizers.json");
$context->inputs->setValidators("../../package/src/uptodate_data/validators.json");
$context->inputs->setFile("./tests/includes/simple5.php");

$context->outputs->resolveIncludesFile("resolve_includes.json");
$context->outputs->resolveIncludes(true);

//$context->inputs->set_includes("./tests/includes/resolved_includes_simple5.txt");

$analyzer->run($context);
