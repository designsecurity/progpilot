<?php

$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_ENCODED);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_MAGIC_QUOTES);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_SPECIAL_CHARS);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_STRING);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, FILTER_SANITIZE_STRIPPED);

echo $safe;



$tainted = $_GET["p"];

$safe = filter_var($tainted, $nexiste_pas);

echo $safe;
