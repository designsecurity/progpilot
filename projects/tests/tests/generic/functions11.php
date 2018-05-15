<?php

function testf1($param)
{
    return $param;
}

$ret = [testf1($_GET["p"]), "olal", "ola"];

echo $ret[0];
echo $ret[1];
