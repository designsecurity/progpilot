<?php

class toto  {
  function getresults() {
    $this->baba(); // remove and it works again
    return $this->last_result;
  }
  
  function baba()   {
    $num_rows = 0;
    while ( $row = @mysql_fetch_object(true) ) {
      $this->last_result[$num_rows] = $row;
      $num_rows++;
    }
  }
}

$inst = new toto;
$aaas = $inst->getresults();

foreach($aaas as $aaa) {
  echo $aaa->title;
}
