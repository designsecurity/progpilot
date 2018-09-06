<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile("./tests/oop/simple1.php");
//$context->outputs->setOnAddResult("var_dump");
$var = function($result) {
    var_dump($result);
};
$context->outputs->setOnAddResult($var);
$analyzer->run($context);

echo "nb files = '".$context->outputs->getCountAnalyzedFiles()."'\n";

