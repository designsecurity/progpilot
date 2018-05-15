<?php

function composerRequire687f153b069c251a8396d68dc94ed595($file)
{
    include($file);
    echo $var1;
}

$copyarrays = include("simple14_include_ret.php");

foreach ($copyarrays as $id_key => $array_value) {
    composerRequire687f153b069c251a8396d68dc94ed595($array_value);
}
