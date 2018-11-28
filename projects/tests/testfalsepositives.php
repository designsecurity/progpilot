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
