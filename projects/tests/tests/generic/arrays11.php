<?php

$toto = $_GET["tata"];
$arr = array(array("ui", $toto), "ha");

echo $arr[0][0];
echo $arr[0][1];
echo $arr[1];
