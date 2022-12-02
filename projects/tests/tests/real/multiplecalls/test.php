<?php

function username_exists( $param_username_exists ) {
  $bar = sanitize_user( $param_username_exists );
}

function sanitize_user($param_sanitize_user) 
{
	return preg_replace('|a-z0-9 _.-|i', '', $param_sanitize_user);
}

$foo = $_POST["bar"];

$user_login = sanitize_user($foo);

username_exists($user_login);

echo $user_login;


