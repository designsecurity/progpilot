<?php

$db = new SQLite3($DB_FILE_ABSOLUTE_PATH); 

$password = $_POST['v_password'];
$username = $_POST['v_username'];

$sql = 'SELECT salt FROM users where username = \''. $username . '\' limit 1';

$user = $db->querySingle($sql, true); 

if(empty($user)){
	$db->close();
	return;
}

$hashedPassword = hash("sha256", "....");
$sql = 'SELECT username FROM users where username = \''. $username . '\' and password = \'' . $hashedPassword. '\' limit 1';

$user = $db->querySingle($sql, true);
