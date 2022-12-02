<?php

// block 3
$var5["t"] = $_GET["t"];

$var6 = &$var5["t"];

echo $var6;

if (true) {
    // block 12
    // if $var5 = "oula"; it's a FP we don't track array from array element
    $var5["t"] = "oula";
} else {
    // block 22
    // if $var5 = "oula"; it's a FP we don't track array from array element
    $var5["t"] = "oula";
}

// block 21
echo $var6;
