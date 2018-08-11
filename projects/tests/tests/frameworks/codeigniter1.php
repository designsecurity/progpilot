<?php
class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        $data['title'] = $_GET["p"];
            
        $this->load->view('templates/header', $data['title']);

        $this->load->view('templates/header', $data);
    }
}

$a = new Pages;
$a->view();
