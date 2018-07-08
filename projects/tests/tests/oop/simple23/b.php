<?php

include_once "c.php";

class DbModel
{
    public $db = null ;
        
    public function __construct()
    {
        $this->db = new MySQL_prog_pilot_test();
    }
        
    public function func2($sql)
    {
        $this->db->query($sql);
    }
}
