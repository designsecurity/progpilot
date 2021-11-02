<?php

class toto  {
  function baba()   {
    $num_rows = 0;
    while ( $row = @mysql_fetch_object(true) ) {
      $this->last_result[$num_rows] = $row;
      //$arow = $this->last_result[$num_rows];
      echo $this->last_result[$num_rows]->title;
      $num_rows++;
    }
  }
}
