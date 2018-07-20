<?php

require_once './vendor/autoload.php';

try {
    if ($argc > 1) {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->inputs->setSources("../../package/src/uptodate_data/sources.json");
        $context->inputs->setSinks("../../package/src/uptodate_data/sinks.json");
        $context->inputs->setSanitizers("../../package/src/uptodate_data/sanitizers.json");
        $context->inputs->setValidators("../../package/src/uptodate_data/validators.json");
        $context->inputs->setCustomRules("../../package/src/uptodate_data/rules.json");
        $context->inputs->setFile($argv[1]);

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
