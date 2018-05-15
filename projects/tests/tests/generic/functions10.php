<?php

function testf1($param)
{
    $arr[8989][1][989] = $param;
    $arr[8989][2][989] = "olalal";
    return [$arr[8989], "nono"];
}

$ret = testf1($_GET["p"]);

echo $ret[0][1][989];
echo $ret[0][2][989];
