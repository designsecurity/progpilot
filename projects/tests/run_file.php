<?php

require_once './vendor/autoload.php';

try {
    if ($argc > 1) {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;
        $context->inputs->setFile($argv[1]);
        
        $context->setLanguages(["php", "js"]);
        $context->setAnalyzeHardrules(true);
        $context->setAnalyzeFunctions(false);
        $context->outputs->taintedFlow(true);

        try {
            $analyzer->run($context);
        } catch (Exception $e) {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }

        var_dump($context->outputs->getResults());
    }
} catch (\RuntimeException $e) {
    $result = $e->getMessage();
}
