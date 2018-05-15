<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

try {
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;

    $context->inputs->set_sources("../../package/src/uptodate_data/sources.json");
    $context->inputs->set_sinks("../../package/src/uptodate_data/sinks.json");
    $context->inputs->set_sanitizers("../../package/src/uptodate_data/sanitizers.json");
    $context->inputs->set_validators("../../package/src/uptodate_data/validators.json");
    $context->inputs->set_include_files("include_files.json");

    try {
        $analyzer->run($context);
    } catch (Exception $e) {
        echo 'Exception : ',  $e->getMessage(), "\n";
    }

    $results = $context->outputs->get_results();
    $outputjson = array('results' => $results);
    $parsed_json = $outputjson["results"];

    var_dump($parsed_json);
} catch (\RuntimeException $e) {
    $result = $e->getMessage();
}
