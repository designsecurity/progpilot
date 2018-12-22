<?php

use Symfony\Component\HttpFoundation\Response as Response;

$response = new Response(
    'Content',
    Response::HTTP_OK,
    array('Access-Control-Allow-Origin' => '*')
);

$response->headers->set('Access-Control-Allow-Origin', '*');
