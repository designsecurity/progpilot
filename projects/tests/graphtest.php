<?php

require_once './vendor/autoload.php';

try
{

    //$file = "./tests/graphs/functionsgraph1.php";
    $file = "./tests/custom/custom1.php";
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;

    $context->inputs->set_file($file);
    $analyzer->run($context);

    //$graphcfg_json = $context->outputs->get_cfg();
    $graphcallgraph_json = $context->outputs->get_callgraph();
    
    echo "\ndigraph callgraph {\nordering=out;\n";
    foreach($graphcallgraph_json["nodes"] as $node)
        echo "node_".$node["id"]." [label=\"".$node["name"]."\"];\n";

    foreach($graphcallgraph_json["links"] as $link)
        echo "node_".$link["source"]."->"."node_".$link["target"]."\n";
    
    echo "\n\n}\n\n";
    //var_dump($graphcfg_json);
    //var_dump($graphcallgraph_json);

}
catch (\RuntimeException $e)
{
    echo 'Exception : ',  $e->getMessage(), "\n";
}

?>
