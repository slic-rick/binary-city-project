<?php
require '../vendor/autoload.php';
require '../src/core/config.php';

// Include the base path so that we easily load _partials.
set_include_path(__DIR__ . '/../src/views/');
ini_set('display_errors', 1);

// session
session_start();


$uri = $_SERVER['REQUEST_URI'];

$router = require '../src/routes/routes.php';


$router->dispatch($uri);

// $router->dispatch();

    