<?php

$tainted = $_GET["p"];
$errors = false;

if(!is_email($tainted)) {
  $errors = true;
}

if(!$errors) {
  echo $tainted;
}
