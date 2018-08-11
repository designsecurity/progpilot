<?php declare(strict_types = 1);
function get()
{
    return $_GET['a'];
}
// tainted
echo $path = get();
// tainted
echo `ls ./$path`;
