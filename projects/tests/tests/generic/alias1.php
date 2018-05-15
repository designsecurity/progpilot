<?php

if (true) { //block1
    $var1 = "test";
} else {   //block3
    $var1 = $_GET["p1"]."test";
}

$var3 = &$var1;

echo "$var3";

/* var3 est tainté = XSS en ligne 14 */
