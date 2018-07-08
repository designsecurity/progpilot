<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("source_code1.php");

$analyzer->run($context);
$results = $context->outputs->getResults();

var_dump($results);
