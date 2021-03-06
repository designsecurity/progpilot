<?php declare(strict_types = 1);
// tainted result
$user = require_once __DIR__ . '/test4F.php';

echo $user['email'];

$user = false;
// ok
if ($bool = array_key_exists('file', $_GET)) {
    //  tainted
    require_once __DIR__ . '/' . $_GET['file'] . '.php';
    $user = require_once __DIR__ . '/test4F.php';
}
// tainted
echo $user['email'];
