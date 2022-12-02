<?php

class wpdb {

	function print_error() {
      echo $this->last_query;
	}
	
	function query($query) {
		$this->last_query = $query;
		if ( true ) {
			$this->print_error();
		}
	}
}


$wpdb = new wpdb;
$wpdb->query($_GET["p"]);

