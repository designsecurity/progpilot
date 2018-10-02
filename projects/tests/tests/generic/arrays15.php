<?php

function testf($param)
{
    return [$param, "nono"];
}

$var = testf($_GET["p"])[0];

echo $var;
