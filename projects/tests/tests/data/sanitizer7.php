<?php

class testc1
{
    public $object;
}

class testc2
{
    public function mysanitizer()
    {
    }
}

$instance = new testc1;

$instance->object = new testc2;

$ret = $instance->object->mysanitizer($_GET["p"]);

echo "$ret";

mysql_query($ret);


class newtestc1
{
    public $object;
}

class newtestc2
{
    public function mysanitizer()
    {
    }
}

$instance1 = new newtestc1;

$instance1->object = new newtestc2;

$ret1 = $instance1->object->mysanitizer($_GET["p"]);

echo "$ret1";

mysql_query($ret1);
