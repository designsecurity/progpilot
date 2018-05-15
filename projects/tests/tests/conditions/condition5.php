<?php

$tainted = $_GET["p"];

$legal_table = array("safe1", "safe2");
if (!in_array($tainted, $legal_table, true) && in_array($tainted, $legal_table, true)) {
    $tainted = $tainted;
} else {
    $tainted = $legal_table[0];
}

echo $tainted;
