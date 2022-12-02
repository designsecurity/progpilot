<?php


$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_BOOLEAN)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_FLOAT)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_INT)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_IP)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_MAC)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_URL)) {
    echo $tainted; // OK
}

$tainted = $_GET["p"];

if(filter_var($tainted, FILTER_VALIDATE_EMAIL))
{
    echo $tainted;// KO
}

$tainted = $_GET["p"];

if (filter_var($tainted, FILTER_VALIDATE_REGEXP)) {
    echo $tainted; // KO
}

$tainted = $_GET["p"];

if (filter_var($tainted, $nexiste_pas)) {
    echo $tainted; // KO
}

