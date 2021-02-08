<?php

$tainted = $_GET["p"];

if(!in_array($tainted, [])) {
  die("dangerous");
}

echo $tainted;