<?php

require_once './vendor/autoload.php';

if ($argc > 1) {
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;
    $context->inputs->setFile($argv[1]);
    $context->inputs->setDev(true);
        
    $context->setDebugMode(true);
    $context->outputs->taintedFlow(true);
    /*
    $context->outputs->resolveIncludes(true);
     $context->outputs->resolveIncludesFile("tmpresolvedincludes.json");
    */
    $analyzer->run($context);

    var_dump($context->outputs->getResults());
}
