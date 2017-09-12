<?php

function testf1($param)
{
    $arr[8989][1][989] = $param."jkjk";
    $arr[8989][2][989] = "olalal";
    return $arr;
}

$ret = [$ret = testf1($_GET["p"]), "olal", "ola"];

echo $ret[0][8989][1][989];
echo $ret[1];

?>
