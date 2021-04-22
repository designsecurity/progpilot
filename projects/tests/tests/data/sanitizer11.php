<?php

$tainted = $_GET["p"];

$safe = (int) $tainted;

echo $safe;
