<?php

$var7 = $_POST["pe"];

$var7safe = rtrim($var7);

echo "$var7safe";

$var7safe1[1] = rtrim($var7);

echo $var7safe1[0];

$var7safe2 = htmlentities($var7);

echo "$var7safe2";
