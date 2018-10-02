<?php

require_once './vendor/autoload.php';

try {
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;

    $context->inputs->setDev(true);
    $context->inputs->setIncludeFiles("include_files.json");

    try {
        $analyzer->run($context);
    } catch (Exception $e) {
        echo 'Exception : ',  $e->getMessage(), "\n";
    }

    $results = $context->outputs->getResults();
    $outputjson = array('results' => $results);
    $parsed_json = $outputjson["results"];

    var_dump($parsed_json);
} catch (\RuntimeException $e) {
    $result = $e->getMessage();
}
