<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setDev(true);
$context->outputs->taintedFlow(true);
$context->setDebugMode(true);
$context->inputs->setInclusions("include_files.json");

$var = function ($result) {
    echo "a result:\n";
    var_dump($result);
};
$context->outputs->setOnAddResult($var);
$analyzer->run($context);

$results = $context->outputs->getResults();
$outputjson = array('results' => $results);
$parsed_json = $outputjson["results"];

var_dump($parsed_json);
