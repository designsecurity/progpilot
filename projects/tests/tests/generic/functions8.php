<?php

function testf1($param)
{
    if (true) {
        $var1 = $_GET["p"];
        echo $var1;
    } else {
        echo "$param";
    }
}

testf1("test");
