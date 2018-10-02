<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->setConfiguration("./configuration.yml");

$analyzer->run($context);
$results = $context->outputs->getResults();

var_dump($results);
