<?php

$a = new Twig_Environment($loader, array("autoescape" => false));

function test($a)
{
    echo $a["bla"];
}

test(array("bla" => $_GET["p"]));

$a = array("bla" => $_GET["p"]);
test($a);

?>
