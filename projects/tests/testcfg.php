<?php

require_once './vendor/autoload.php';

$code = "<?php function testf(\$param){	return [\$param, \"nono\"];}\$var = testf(\$_GET[\"p\"])[0];echo \$var;?>";

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->setAnalyzeJs(false);
$context->setAnalyzeIncludes(false);
$context->inputs->setCode($code);
$analyzer->run($context);

$results = $context->outputs->getAst();

var_dump($results);
