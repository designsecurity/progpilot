<?php

function validate_file2($file) {

	$next = false;
	if (in_array($file, $allowed_files)) {
		$next = true;
		return $next;
	}

	return $next;
} 

$a = $_GET["p"];

if(validate_file2($a)) {
	include($a);
}
else {
	include($a);
}