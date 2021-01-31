<?php

class test1
{
    private $test2;
    
    public function __construct() {
      $this->test2 = new test2();
    }
    
    public function getTest2() {
      return $this->test2;
    }
};

class test2
{
    private $test3;
    
    public function __construct() {
      $this->test3 = new test3();
    }
    
    public function getTest3() {
      return $this->test3;
    }
};

class test3
{
    public function insecure($tainted) {
      echo $tainted;
    }
};

$t = new test1();
$t->getTest2()->getTest3()->insecure($_GET["p"]);

