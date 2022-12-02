<?php


function testf1($param2)
{
    echo $param2["test"];
}

$toto = array("test" => $_GET["p"]);

testf1(array("test" => $_GET["p"]));
