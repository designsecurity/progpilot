<?php

$myvar1 = $_GET["p"];

function test_global1()
{
    test_global2();
}

function test_global2()
{
    global $myvar1;
  
    echo $myvar1;
}

test_global1();
