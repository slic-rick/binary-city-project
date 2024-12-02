<?php
namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;

class AddContact extends Controller {


    public function index() {
        $this->renderView('addContact/index', ['contacts' => []]);
    }

}