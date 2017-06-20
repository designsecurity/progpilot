<?php

require_once './vendor/autoload.php';

use progpilot\Representations\Callgraph;
use progpilot\Representations\ControlFlowGraph;

try {

	$file = "./tests/graphs/functionsgraph1.php";

	$analyzer = new \progpilot\Analyzer;

	$results = [];
	$analyzer->set_file($file);
	$analyzer->set_results($results);
	$analyzer->run_parser();
	$analyzer->run_transform();

	$callgraphanalyzer = new Callgraph;
	$callgraphanalyzer->set_mycode($analyzer->get_mycode());
	$callgraphanalyzer->analyze();

	$graphjson = $callgraphanalyzer->get_graphjson();
	var_dump($graphjson);


	$file = "./tests/graphs/functionsgraph1.php";

	$analyzer = new \progpilot\Analyzer;

	$results = [];
	$analyzer->set_file($file);
	$analyzer->set_results($results);
	$analyzer->run_parser();
	$analyzer->run_transform();

	$cfganalyzer = new ControlFlowGraph;
	$cfganalyzer->set_mycode($analyzer->get_mycode());
	$cfganalyzer->analyze();

	$graphjson = $cfganalyzer->get_graphjson();
	var_dump($graphjson);


} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
