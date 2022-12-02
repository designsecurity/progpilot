<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$arr = [
        array("vuln_id" => "f31cec392303e924f666116fd67d897c92e8a59a5e8ca93a65091701ca9db558")
    ];
$context->inputs->setFile("./tests/generic/simple1.php");
$context->inputs->setFalsePositives($arr);

$analyzer->run($context);
var_dump($context->outputs->getResults());

$arr = [
        array("vuln_id" => "a6c0d68d130972bd4e23ae6c68d548d5cf8d40a78e73136a1b89dab8f3b441c1")
    ];
    
$context->inputs->setDev(true);
$context->inputs->setFile("./tests/custom/custom1.php");
$context->inputs->setFalsePositives($arr);

$analyzer->run($context);
var_dump($context->outputs->getResults());
