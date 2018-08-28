<?php

class Pages extends CI_Model
{
    public function model()
    {
        $query = $this->db->query("YOUR QUERY");
        
        $result = $query->result();
        
        foreach($result as $row)
            echo $row->title;
    }
}

$a = new Pages;
$a->model();
