<?php

require_once './vendor/autoload.php';

$code = "<?php function testf(\$param){	return [\$param, \"nono\"];}\$var = testf(\$_GET[\"p\"])[0];echo \$var;?>";

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setSources("../../package/src/uptodate_data/sources.json");
$context->inputs->setSinks("../../package/src/uptodate_data/sinks.json");
$context->inputs->setSanitizers("../../package/src/uptodate_data/sanitizers.json");
$context->inputs->setValidators("../../package/src/uptodate_data/validators.json");
$context->setAnalyzeJs(false);
$context->setAnalyzeIncludes(false);
$context->inputs->setCode($code);
try {
    $analyzer->run($context);
} catch (Exception $e) {
    echo 'Exception : ',  $e->getMessage(), "\n";
}

$results = $context->outputs->getAst();

var_dump($results);
