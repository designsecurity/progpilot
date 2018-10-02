<?php

$tainted = $_GET["p"];

$bool = settype($tainted, "float");

echo $tainted;

if (true) {
    $tainted2 = "eee";
} else {
    $tainted2 = $_GET["p"];
}

$bool = settype($tainted2, "float");

echo $tainted2;

$tainted3 = $_GET["p"];

$bool = settype($tainted3, "flddoat");

echo $tainted3;
