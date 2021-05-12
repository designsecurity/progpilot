<?php 

namespace testnsfirstlevel1\nssecondlevel2;

use testnsfirstlevel1\nssecondlevel1;

class Foo2
{
  public function callfoo1($tainted)
  {
    $f1 = new nssecondlevel1\Foo1();
    $f1->xssvuln($tainted);
    $f1->xssvuln($_GET["p"]);
  }
}

 
