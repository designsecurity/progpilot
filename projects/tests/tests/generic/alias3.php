<?php

$var5 = $_GET["t"];
$var6 = $_GET["p"];

if (true) { //block1
    $var7 = &$var5;
} else {   //block3
    $var7 = &$var6;
}

echo "$var7";

/* var3 est doublement tainté = XSS en ligne 15 */
