<?php

$var7 = $_POST["pe"];

$var7safe3 = htmlentities(addslashes($var7));

echo "$var7safe3";

$var7safe3 = addslashes(htmlentities($var7));

echo "$var7safe3";

$var7safe3 = htmlentities(htmlentities($var7));

echo "$var7safe3";

$var7safe3 = rtrim(htmlentities($var7));

echo "$var7safe3";

echo "$var7";
