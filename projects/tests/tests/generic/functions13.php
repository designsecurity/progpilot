<?php

function testf1($param)
{
    return [$param, "ola", "allo"];
}

$ret = [testf1($_GET["p"]), "olal", "ola"];

echo $ret[0][0];
echo $ret[0][1];
echo $ret[1];
