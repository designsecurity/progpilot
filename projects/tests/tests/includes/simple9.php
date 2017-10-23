<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', './' );

$vulnerabilityFile = '';
switch ( $_COOKIE[ 'security' ] )
{
case 'low':
    $vulnerabilityFile = 'low.php';
    break;
case 'medium':
    $vulnerabilityFile = 'medium.php';
    break;
case 'high':
    $vulnerabilityFile = 'high.php';
    break;
default:
    $vulnerabilityFile = 'impossible.php';
    break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "dvwa/{$vulnerabilityFile}";

?>
