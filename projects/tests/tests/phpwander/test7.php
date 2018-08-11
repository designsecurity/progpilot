<?php declare(strict_types = 1);
$items = [
    3,
    $_GET['b'],
    'str',
    4 => 1.4,
    new \stdClass,
];
foreach ($items as $param) {
    echo $param;
}
