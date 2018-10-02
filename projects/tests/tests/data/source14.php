<?php

$script = "/tmp/tainted.php";

exec($script, $result, $return);

$tainted = $result[0];

echo $result;

echo $tainted;

echo $_GET;
