<?php

/* compatibility matrix */
// 1) first class is defined  : a) unknown middle class, b) known middle class, c) unknown middle class but it exists
// 2) first class is undefined  : a) no middle class
// 3) first class is undefined : a) unknown middle class, b) known middle class, c) unknown middle class but it exists

class known_class1
{
    public $middle_object;
};

class known_middle_class2
{
    public function mysink()
    {
    }
}

class unknown_middle_class2
{
    public function mysink()
    {
    }
};

// 1)b) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_middle_class2"}
$instance1 = new known_class1;

$instance1->middle_object = new known_middle_class2;

$instance1->middle_object->mysink($_GET["p"]);

// 1)a) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_class1->middle_object"}
$instance2 = new known_class1;

$instance2->middle_object->mysink($_GET["p"]);


// 1)c) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_class1->middle_object"}
$instance3 = new known_class1;

$instance3->middle_object = new unknown_middle_class2;

$instance3->middle_object->mysink($_GET["p"]);


// 2)a) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_class1_undefined"}
$instance4 = new known_class1_undefined;

$instance4->mysink($_GET["p"]);

// 3)b) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_middle_class2"}
$instance5 = new known_class1_undefined;

$instance5->middle_object = new known_middle_class2;

$instance5->middle_object->mysink($_GET["p"]);


// 3)a) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_class1_undefined->middle_object"}
$instance2 = new known_class1_undefined;

$instance2->middle_object->mysink($_GET["p"]);


// 3)c) : should be found by this sink declaration : {"name" : "mysink", "instanceof" : "known_class1_undefined->middle_object"}
$instance3 = new known_class1_undefined;

$instance3->middle_object = new unknown_middle_class2;

$instance3->middle_object->mysink($_GET["p"]);
