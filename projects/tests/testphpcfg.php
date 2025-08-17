<?php

require_once './vendor/autoload.php';

if ($argc > 1) {
    $astparser = (new \PhpParser\ParserFactory)->createForNewestSupportedVersion();

    $parser = new \PHPCfg\Parser($astparser);

    $script = $parser->parse(file_get_contents($argv[1]), $argv[1]);

    $dumper = new PHPCfg\Printer\Text();
    echo $dumper->printScript($script);
}
