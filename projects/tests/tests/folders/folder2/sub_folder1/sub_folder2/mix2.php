<?php

if (true) { //block1
    $var1 = array($_GET["p1"]);
} else {   //block3
    $var1 = $_GET["p1"];
}

echo $var1;
