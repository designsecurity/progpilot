<?php declare(strict_types = 1);
/*
include("test13E.php");

$e = new E;
$result = $e->get();
echo $result;
*/
 
foreach ([$_GET["p"]] as $value) {
    echo $value;
}
