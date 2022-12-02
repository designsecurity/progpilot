<?php

$tainted = $_GET["p"];

if(in_array($tainted, [])) {
  echo $tainted;
}
else {
  echo $tainted;
}