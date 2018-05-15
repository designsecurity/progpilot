<?php

function testf1($param)
{
    $arr[8989][1][989] = $param."jkjk";
    $arr[8989][2][989] = "olalal";
    return $arr;
}

$ret_gauche = [$ret_droite = testf1($_GET["p"])];

echo $ret_gauche[0][8989][1][989];
echo $ret[1];
