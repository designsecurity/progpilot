<?php 

	require_once('wp-config.php');
	
	$comments = $wpdb->get_results($_GET["p"]);
