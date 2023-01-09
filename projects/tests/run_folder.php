<?php

require_once './vendor/autoload.php';

if ($argc > 1) {
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;
    $context->inputs->setFolder($argv[1]);
    $context->inputs->setDev(true);
    $context->setDebugMode(true);
    $context->outputs->taintedFlow(true);
        
    $exclusions = [
        "./tests/folders/folder2/mix3.php",
        "./tests/folders/folder2/sub_folder1/sub_folder2"
    ];

    $context->inputs->addExclusions($exclusions);
    $analyzer->run($context);

    var_dump($context->outputs->getResults());
}
