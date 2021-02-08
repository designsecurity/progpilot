<?php

$tainted = $_GET["p"];

$errors = true;
if(is_email($tainted)) {
  $errors = false;
}

if($errors) {
  echo $tainted;
}
else {
  echo $tainted;
}
