<?php

class wpdb
{
	function get_results() {
		$row = @mysql_fetch_object(true);
    return $row;
  }
}

$wpdb = new wpdb();
