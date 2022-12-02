<?php

function testf($param)
{
    return [$param, "nono"];
}

$var1 = testf($_GET["p"])[0];

echo $var1;

$var2 = testf($_GET["p"])[1];

echo $var2;
