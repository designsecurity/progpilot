<?php

class testc1
{
	public $object;
}

class testc2
{
	public function mysink()
	{

	}
}

$instance = new testc1;

$instance->object = new testc2;

$instance->object->mysink($_GET["p"]);


class newtestc1
{
	public function mysink()
	{

	}
}


$instance1 = new newtestc1;

$instance1->mysink($_GET["p"]);



$instance2 = new newtestc12;

$instance2->mysink($_GET["p"]);



$instance2 = new newtestc123;

$instance2->object->mysink($_GET["p"]);


?>	
