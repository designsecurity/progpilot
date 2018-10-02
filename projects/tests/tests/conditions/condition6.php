<?php

$tainted = $_GET["p"];

$legal_table = array("safe1", "safe2");
if (in_array($tainted, $legal_table, true)) {
    echo $tainted;
}

$legal_table = array("safe1", "safe2", $_GET["piou"]);
if (in_array($tainted, $legal_table, true)) {
    echo $tainted;
}
