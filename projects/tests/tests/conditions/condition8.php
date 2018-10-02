<?php


$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_BOOLEAN)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_FLOAT)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_INT)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_IP)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_MAC)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_URL)) {
    echo $tainted;
}
/*
$tainted = $_GET["p"];

if(filter_var($tainted, FILTER_VALIDATE_EMAIL))
{
    echo $tainted;
}
*/
$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_REGEXP)) {
    echo $tainted;
}

$tainted = $_GET["p"];

if (filter_var($tainted, nexiste_pas)) {
    echo $tainted;
}
