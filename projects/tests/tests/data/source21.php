<?php

class wpdb {
	function query() {
		$this->last_result = null; // block 9
		if(true) {
      echo "baba"; // block 19
    }
    else  {
      echo "titi"; // block 33
      
      while ( $row = @mysql_fetch_object(true) ) { // block 41 et 48 (row)
        $this->last_result = $row; // block 52
      }
      
      echo "bibi"; // block 62
    }
    
    echo $this->last_result->title; // block 26
  }
}
