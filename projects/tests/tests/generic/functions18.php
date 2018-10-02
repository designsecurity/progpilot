<?php

class testc1
{
    public static function testf1($param2)
    {
        echo $param2;
    }
}

testc1::testf1($_GET["p"]);
