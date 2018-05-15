<?php

class testc1
{
    private $member1;
    public $object1;

    public function set_object1($val)
    {
        $this->object1 = $val;
    }
  
    public function get_object1()
    {
        return $this->object1;
    }
};

$newsettestc1 = new testc1;

$newsettestc1->set_object1($_GET["p"]);

echo $newsettestc1->get_object1();
