<?php

function testf1($var)
{
    testf1($var);

    return $var;
}

$var = testf1($_GET["p"]);
echo $var;
