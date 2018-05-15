<?php

if (true) { //block1
    $var1 = array("ee", "lklk");
} else {   //block3
    $var1 = array("lklk", $_GET["p1"]);
}

$var2 = $var1;

echo $var2[1];
echo $var2[0];
