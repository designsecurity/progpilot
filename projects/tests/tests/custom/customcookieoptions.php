<?php

$options = array(
    'expires' => time() + 2592000,
    'path' => '/',
    'domain' => '',
    //'secure' => FALSE,
    'httponly' => true,
    'samesite' => 'Lax'
);

setcookie("token", "123", $options);
