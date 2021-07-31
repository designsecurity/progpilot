<?php

class test1
{
    private $test2;
    public $test2property;
    
    public function __construct() {
      $this->test2 = new test2();
      $this->test2property = new test2();
    }
    
    public function getTest2() {
      return $this->test2;
    }
};

class test2
{
    private $test3;
    public $test3property;
    
    public function __construct() {
      $this->test3property = new test3();
    }
};

class test3
{
    public function insecure($tainted) {
      echo $tainted;
    }
};

$t = new test1();
$t->getTest2()->test3property->insecure($_GET["p"]);
