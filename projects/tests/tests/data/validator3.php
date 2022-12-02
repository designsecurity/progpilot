<?php

$tainted = $_GET["p"];

if(!in_array_false($tainted)) {
  echo $tainted;
}
else {
  echo $tainted; // vuln
}

if(!in_array_true($tainted)) {
  echo $tainted; // vuln
}
else {
  echo $tainted;
}
