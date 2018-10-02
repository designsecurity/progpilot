<?php

require_once './vendor/autoload.php';

$print_arr = "";

$arr = array("bla" => false);

\progpilot\Utils::printArray($arr, $print_arr);

$print_arr = "";

$arr = array("bla" => array("biouuu" => false));

\progpilot\Utils::printArray($arr, $print_arr);

echo "$print_arr\n";
