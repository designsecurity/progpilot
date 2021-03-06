<?php

require_once './vendor/autoload.php';

try {
    if ($argc > 1) {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;
        $context->inputs->setFile($argv[1]);
        $context->inputs->setDev(true);
        $context->inputs->setLanguages(["php", "js"]);
        $context->inputs->setFrameworks(["suitecrm", "codeigniter", "prestashop", "symfony"]);
        
        $context->setAnalyzeHardrules(true);
        $context->setPrintWarning(true);
        $context->outputs->taintedFlow(true);
        /*
        $context->outputs->resolveIncludes(true);
        $context->outputs->resolveIncludesFile("tmpresolvedincludes.json");
        */
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
