<?php

function testf1($var_param)
{
    echo $var_param[1][12];
}

$var[1][11] = "kkk";
$var[1][12] = $_GET["p"];
$var[1][13] = "kkk";

testf1($var);


$var1[1][11] = "kkk";
$var1[1][12] = "kkk";
$var1[1][13] = "kkk";

testf1($var1);
