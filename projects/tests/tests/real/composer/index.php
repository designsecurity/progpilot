<?php

require "./notexcluded_vendor/autoload.php";

echo blabla();

$obj = new test_tainted();
$obj->return_tainted_source();
