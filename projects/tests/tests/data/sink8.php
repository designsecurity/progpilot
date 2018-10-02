<?php

$query = $_GET["p"];

$xml = simplexml_load_file("users.xml");

$res = $xml->xpath($query);
