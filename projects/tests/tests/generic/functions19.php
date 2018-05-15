<?php


function testf1($param2)
{
    echo $param2["test"];
}


testf1(array("test" => $_GET["p"]));
