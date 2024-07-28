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
