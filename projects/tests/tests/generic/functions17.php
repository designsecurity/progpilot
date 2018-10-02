<?php

function testf1($param2)
{
    echo $param2;
}

function testf2($param1)
{
    return $param1;
}

testf1(testf2($_GET["p"]));
