<?php

$tainted = $_GET["p"];

$safe = (int) $tainted;

$notsafe = (string) $tainted;

echo $notsafe;

echo $safe;

echo $tainted;
