<?php

$data = mysql_fetch_object($res);

echo $data->boum;

echo $data["boum"];

echo $data;

print_r($data);

print_r($data->boum);

while($data = mysql_fetch_object($res))
{
    echo $data->boum;

    echo $data["boum"];

    echo $data;

    print_r($data);

    print_r($data->boum);
}
