<?php

function testf($parama, $boum, $tchka)
{
    return [$parama, ""];
}

$safea = testf($_GET["p"], "argument2", "argument3");

echo $safea[0];
