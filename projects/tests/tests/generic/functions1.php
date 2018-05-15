<?php

function testf($parama, $boum, $tchka)
{
    echo $parama;

    $safea = htmlentities($parama);

    echo $safea;

    return $parama;
}

testf($_GET["p"], "argument2", "argument3");
