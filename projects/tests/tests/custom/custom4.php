<?php

$a = new Twig_Environment($loader, array("autoescape" => false, "test" => "toto"));

$a = new Twig_Environment($loader, array("autoescape" => true, "test" => "toto"));

$a = new Twig_Environment($loader, array("autoescape" => "html", "test" => "toto"));

$a = new Twig_Environment($loader);
