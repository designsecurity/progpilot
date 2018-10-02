<?php

function testf1($param)
{
    $arr[8989][1] = $param;
    $arr[8989][2] = "olalal";
    return [$arr, "nono"];
}

$ret = testf1($_GET["p"]);

echo $ret[0][8989][1];
echo $ret[0][8989][2];
