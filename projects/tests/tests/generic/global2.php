<?php


$myvar1 = $_GET["p"];

function test_global()
{
    echo $GLOBALS["myvar1"];
}

test_global();
