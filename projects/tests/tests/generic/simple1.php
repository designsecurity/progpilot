<?php

$myvar1 = $_GET["p"];

$myvar2 = $myvar1;

$myvar3 = $myvar2;

$myvar4 = $myvar3;

echo "$myvar4";

$myvar2 = "olala";
echo $myvar2;
