<?php

class testc1
{
	private $member1;
	
	public function print_member1()
	{
        echo $this->member1;
	}
};


$testc1 = new testc1;

$testc1->member1 = $_GET["p"];

$testc1->print_member1();

?> 


