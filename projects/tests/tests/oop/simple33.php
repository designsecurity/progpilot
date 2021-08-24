<?php

class test1
{
    private $test2;
    
    public function __construct() {
      // block 26 (parents = 3)
      $this->test2 = new test2();
    }
    
    public function getTest2() {
      // block 33 (parents = 3)
      return $this->test2;
    }
};

class test2
{
    private $test3;
    
    public function __construct() {
      // block 39 (parents = 26)
      $this->test3 = new test3();
    }
    
    public function getTest3() {
      // block 46 (parents = 3)
      return $this->test3;
    }
};

class test3
{
    public function insecure($tainted) {
      // block 53
      echo $tainted;
    }
};


// block 3
$t = new test1();
$t->getTest2()->getTest3()->insecure($_GET["p"]);

