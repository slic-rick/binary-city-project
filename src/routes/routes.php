<?php

use Framework\Core\Router;
use Framework\Controllers\HomeController;
use Framework\Controllers\ContactsController;
use Framework\Controllers\AddClient;
use Framework\Controllers\AddContact;
use Framework\Controllers\EditContact;

$router = new Router();

$router->addRoute('/', HomeController::class, 'index');
$router->addRoute('/contacts', ContactsController::class, 'index');
$router->addRoute('/add-client', AddClient::class, 'index');
$router->addRoute('/add-contact', AddContact::class, 'index');
$router->addRoute('/search', HomeController::class, 'search');
$router->addRoute('/contactsearch', ContactsController::class, 'search');
$router->addRoute('/editclient', AddClient::class, 'index');
$router->addRoute('/editcontact', EditContact::class, 'index');
$router->addRoute('/updateContact',EditContact::class,'updateContact');
$router->addRoute('/get-contacts', AddClient::class, 'getContacts');
$router-> addRoute('/get-linked-contacts',AddClient::class,'getLinkedContacts');
$router-> addRoute('/get-clients',AddContact::class,'getClients');

$router-> addRoute('/get-linked-clients',AddContact::class,'getLinkedClients');
$router-> addRoute('/unlink-client',AddContact::class,'unlinkClient');
// unlink-client

// unlinkContact
$router-> addRoute('/unlink-contact',AddClient::class,'unlinkContact');

// $router->get('/', HomeController::class, 'index');
// $router->get('/contacts', ContactsController::class, 'index');
// $router->get('/add-client', AddClient::class, 'index');
// $router->get('/add-contact', AddContact::class, 'index');

// $router->dispatch();

return $router;
    