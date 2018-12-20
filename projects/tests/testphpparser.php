<?php

require_once './vendor/autoload.php';

use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;

if ($argc > 1) {
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    try {
        $ast = $parser->parse(file_get_contents($argv[1]));
    } catch (Error $error) {
        echo "Parse error: {$error->getMessage()}\n";
        return;
    }

    $dumper = new NodeDumper;
    echo $dumper->dump($ast) . "\n";

    
    $parser = new PHPCfg\Parser(
    (new PhpParser\ParserFactory)->create(PhpParser\ParserFactory::PREFER_PHP7)
    );    
    
    $script = $parser->parse(file_get_contents($argv[1]), $argv[1]);
}

