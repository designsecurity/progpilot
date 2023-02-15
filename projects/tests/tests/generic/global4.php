<?php

$maxdb = new maxdb("localhost", "MONA", "RED", "DEMODB");
function test() {
	global $maxdb;
	$maxdb->query($_POST['form_id']);
}

test();