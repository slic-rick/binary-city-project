<?php

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;
use Framework\Models\Contact;

class ContactsController extends Controller{

    public function index() {
        $_SESSION = [];
        $contact = new Contact;

        $contacts = $contact -> getContacts();
        $this->renderView('contacts/index', ['contacts' => $contacts]);
    }

}