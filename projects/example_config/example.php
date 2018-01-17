<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->set_configuration("./configuration.yml");

$analyzer->run($context);
$results = $context->outputs->get_results();

echo json_encode($results);

?>
