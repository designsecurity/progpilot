<?php

require_once './vendor/autoload.php';

$context = new \progpilot\Context;
$analyzer = new \progpilot\Analyzer;

$context->set_configuration("./configuration.yml");
$context->read_configuration();

?>	 
