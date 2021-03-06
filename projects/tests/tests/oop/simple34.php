<?php

class Input
{
    public $input;

    public function getInput()
    {
        $this->input = $_GET['UserData'];
        
        return $this->input;
    }
}
$temp = new Input();

$tainted =  $temp->getInput();

echo $tainted;
 
