<?php
require "Router.php";

use APP\Routing\Router;


Router::get('/', function () {
    echo "Welcome to the homepage!";
});

Router::get('/hello', function () {
    echo  "Hello, World!  This is the /hello page.";
});

Router::get('/hello/world', function () {
    echo  'Hello, World!  This is the hello/world page.';
});

Router::get('/greet/(\w+)', function ($name) {
    echo  ' Hello, ' . $name . '!';
});

Router::get('/greet/(\w+)/title/(\w+)', function ($name,$title) {
    echo  ' Hello, ' . $title . ' ' . $name . '!';
});

Router::get('/verb', function (){
    echo $_SERVER["REQUEST_METHOD"];
});

Router::post('/verb', function (){
    echo $_SERVER["REQUEST_METHOD"];
});


Router::delete('/verb', function (){
    echo $_SERVER["REQUEST_METHOD"];
});


Router::cleanup();