<?php

$arrays[0] = "simple13_include.php";
$arrays[1] = "simple13fake_include.php";

$copyarrays = $arrays;

foreach ($copyarrays as $array_value) {
    include($array_value);
}

echo $var1;
