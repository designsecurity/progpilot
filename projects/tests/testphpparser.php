<?php

require_once './vendor/autoload.php';

use PhpParser\Error;
use PhpParser\NodeDumper;

if ($argc > 1) {
    $astparser = (new \PhpParser\ParserFactory)->createForNewestSupportedVersion();

    $parser = new \PHPCfg\Parser($astparser);

    try {
        $ast = $parser->parse(file_get_contents($argv[1]));
    } catch (Error $error) {
        echo "Parse error: {$error->getMessage()}\n";
        return;
    }

    $dumper = new NodeDumper;
    echo $dumper->dump($ast) . "\n";

    $astparser = (new \PhpParser\ParserFactory)->createForNewestSupportedVersion();

    $parser = new \PHPCfg\Parser($astparser);

    $script = $parser->parse(file_get_contents($argv[1]), $argv[1]);
}
