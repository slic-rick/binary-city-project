<?php

use Framework\Core\Router;
use Framework\Controllers\HomeController;
use Framework\Controllers\ContactsController;
use Framework\Controllers\AddClient;
use Framework\Controllers\AddContact;

$router = new Router();

$router->addRoute('/', HomeController::class, 'index');
$router->addRoute('/contacts', ContactsController::class, 'index');
$router->addRoute('/add-client', AddClient::class, 'index');
$router->addRoute('/add-contact', AddContact::class, 'index');

// $router->get('/', HomeController::class, 'index');
// $router->get('/contacts', ContactsController::class, 'index');
// $router->get('/add-client', AddClient::class, 'index');
// $router->get('/add-contact', AddContact::class, 'index');

// $router->dispatch();

return $router;
    