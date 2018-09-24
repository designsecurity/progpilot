<?php

class Pages extends CI_Model
{
    public function model()
    {
        $query = $this->db->query("YOUR QUERY");
        
        $row = $query->row_array();
        
        echo $row["test"];
    }
}

$a = new Pages;
$a->model();
