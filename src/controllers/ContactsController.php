<?php

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;

class ContactsController extends Controller{

    public function index() {
        $this->renderView('contacts/index', ['contacts' => []]);
    }

}