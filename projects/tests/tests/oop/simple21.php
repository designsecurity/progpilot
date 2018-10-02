<?php

class Sanitize
{
    public $data;
    public function __construct($input)
    {
        $this->data = $input ;
    }
    public function getData()
    {
        return $this->data;
    }
    public function sanitize()
    {
        $this->data = mysql_real_escape_string($this->data) ;
    }
}
$sanitizer = new Sanitize($_GET["p"]) ;
$sanitizer->sanitize();
$tainted = $sanitizer->getData();

$query = "//User[@username='". $tainted . "']";

$xml = new simplexml_load_file("users.xml");//file load
//echo "query : ". $query ."<br /><br />" ;

$res = $xml->xpath($query); //execution
print_r($res);
echo "<br />" ;
