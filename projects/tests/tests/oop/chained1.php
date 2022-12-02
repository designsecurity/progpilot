<?php

class test1
{
    private $test2;
    //public $test2property;
    
    public function __construct() {
      // blockid 26
      $this->test2 = new test2();
      //$this->test2property = new test2();
    }
    
    public function getTest2() {
      // blockid 37
      return $this->test2;
    }
};

class test2
{
    //private $test3;
    public $test3property;
    
    public function __construct() {
      // blockid 43
      $this->test3property = new test3();
    }
};

class test3
{
    public function insecure($tainted) {
      // blockid 51
      echo $tainted;
    }
};

// blockid3
$t = new test1();
$a = $t->getTest2()->test3property->insecure($_GET["p"]);
