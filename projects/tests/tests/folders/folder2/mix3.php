<?php

if (true) { //block1
    $var1 = array($_GET["p1"]);
} else {   //block3
    $var1 = $_GET["p1"];
}

$var2 = $var1;



echo $var2;
