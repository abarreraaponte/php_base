<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$map = [
    '/' => 'home',
    '/articles' => 'articles', 
    '/article/es' => 'article_es',
    '/article/en' => 'article_en',
];

$path = $request->getPathInfo();

if(isset($map[$path])) {
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf(__DIR__.'/../pages/%s.php', $map[$path]);
    $response = new Response(ob_get_clean());
}

else {
    $response = new Response('Not Found', 404);
}

$response->send();