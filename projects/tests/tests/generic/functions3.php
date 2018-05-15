<?php

function testf($parama, $boum, $tchka)
{
    $safea = htmlentities($parama);

    return [$parama, $safea];
}

$a = $_GET["attack"];

$arraysafe = testf($a);

echo $arraysafe[0];
echo $arraysafe[1];
