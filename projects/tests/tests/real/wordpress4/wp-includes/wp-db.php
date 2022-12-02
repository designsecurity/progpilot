<?php

class wpdb {

	function query($query) {
		$this->result = @mysql_query($query, $this->dbh);
	}
	
	function get_results($query = null, $output = OBJECT) {
		$this->query($query);
	}
}

$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
?>
