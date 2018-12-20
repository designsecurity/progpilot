<?php

require_once './vendor/autoload.php';

if ($argc > 1) {
    $parser = new PHPCfg\Parser(
    (new PhpParser\ParserFactory)->create(PhpParser\ParserFactory::PREFER_PHP7)
    );    
    
    $script = $parser->parse(file_get_contents($argv[1]), $argv[1]);
    
    $dumper = new PHPCfg\Printer\Text();
    echo $dumper->printScript($script);
}

