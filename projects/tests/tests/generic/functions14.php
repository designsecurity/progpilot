<?php

function testf1($param)
{
    echo $param;
}

if (testf1($_GET["p"])) {
    echo "oulala";
}
