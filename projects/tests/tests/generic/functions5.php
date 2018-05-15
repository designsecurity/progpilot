<?php

function testf($param)
{
    return [$param, "nono"];
}

echo testf($_GET["p"])[0]."olalal";
