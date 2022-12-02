<?php

require_once './vendor/autoload.php';

$file = "./tests/data/source16.php";
$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->inputs->setFile($file);
$analyzer->run($context);

$graphCfgJson = $context->outputs->getCfg();
$graphCallgraphJson = $context->outputs->getCallGraph();
    
echo "\ndigraph callgraph {\nordering=out;\n";
foreach ($graphCallgraphJson["nodes"] as $node) {
    echo "node_".$node["id"]." [label=\"".$node["name"]."\"];\n";
}

foreach ($graphCallgraphJson["links"] as $link) {
    echo "node_".$link["source"]."->"."node_".$link["target"]."\n";
}
    
echo "\n\n}\n\n";
    
/*
echo "\ndigraph cfg {\nordering=out;\n";
foreach ($graphCfgJson["nodes"] as $node) {
    echo "node_".$node["id"]." [label=\"".$node["name"]."\"];\n";
}

foreach ($graphCfgJson["links"] as $link) {
    echo "node_".$link["source"]."->"."node_".$link["target"]."\n";
}
    
echo "\n\n}\n\n";
*/
