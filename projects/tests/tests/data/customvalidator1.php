<?php
/*
function validate_file($file, $allowed_files = '') {
	if (false !== strpos($file, './'))
		return 1;

	if (':' == substr($file, 1, 1))
		return 2;

	if (!empty ($allowed_files) && (!in_array($file, $allowed_files)))
		return 3;

	return 0;
} 
*/

function validate_file2($file) {

	if (in_array($file, $allowed_files))
		return 3;

	return 0;
} 

$a = $_GET["p"];

if(validate_file2($a)) {
	include($a);
}
else {
	include($a);
}