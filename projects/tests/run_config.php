<?php

require_once './vendor/autoload.php';

if ($argc > 1) {
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;
    
    $context->setConfiguration($argv[1]);
        
    $analyzer->run($context);

    var_dump($context->outputs->getResults());
}
