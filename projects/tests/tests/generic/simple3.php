<?php

if (true) { //block1
    $var7 = $_GET["p"];
} else {   //block3
    $var7 = "test";
}

echo "$var7";

/* var3 est tainté = XSS en ligne 15 */
