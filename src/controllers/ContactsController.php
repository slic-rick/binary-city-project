<?php

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;
use Framework\Models\Contact;

class ContactsController extends Controller{

    public function index() {
        $contact = new Contact;

        $contacts = $contact -> getContacts();

        // echo "<pre>";
        // echo print_r($contacts);
        // echo "</pre>";
        $this->renderView('contacts/index', ['contacts' => $contacts]);
    }

}