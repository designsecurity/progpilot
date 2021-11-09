<?php

class wpdb {
	function query($query) {
		$this->last_result = null;

		if ( true ) {
		} else {
			$num_rows = 0;
			while ( $row = @mysql_fetch_object(true) ) {
				$this->last_result = $row;
				$num_rows++;
			}
		}
	}
	
	function get_results() {
		$this->query($query);
    return $this->last_result;
	}
}

$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);


if (true) {
  $aaas = $wpdb->get_results();
}
else {
  $aaas = $wpdb->get_results();
}

echo $aaas->title;
