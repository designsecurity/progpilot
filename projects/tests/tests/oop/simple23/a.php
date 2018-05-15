<?php

include_once "b.php";

$var = $_GET['taintedInput'];
//$var = "1 or 1 =1";

func1($var);


function func1($queueId)
{
    $sql = "select * from mytable where id = " .$queueId;
    $model = new DbModel();

    $results = $model->func2($sql);

    var_dump($results);
}
