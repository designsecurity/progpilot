<?php

$var5 = "test";
$var6 = $_GET["p"];

if (true) { //block1
    $var7 = &$var5;
} else {   //block3
    $var7 = &$var6;
}

echo "$var7";

/* var3 est tainté = XSS en ligne 15 */
