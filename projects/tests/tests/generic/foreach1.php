<?php

$arrays[0] = "eee";
$arrays[1] = $_GET["p"];

foreach ($arrays as $array_id => $array_value) {
    // array_id = 0
    // array_value = arrays[0] = "eee"
  
    // array_id = 1
    // array_value = arrays[1] = $_GET["p"]
    echo $array_value;
}
