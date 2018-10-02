<?php

$arrays[0] = "simple11_include.php";
$arrays[1] = "simple11fake_include.php";

foreach ($arrays as $array_value) {
    include($array_value);
}

echo $var1;
