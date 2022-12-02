<?php

if (true) { //block4
    $var1 = array("ee", "lklk");
} else {   //block21
    $var1[11] = array("lklk", $_GET["p1"]);
}

// enter block12
$var2 = $var1;

echo $var2[11][1];
echo $var2[0];
