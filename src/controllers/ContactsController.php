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

    
    public function search()
    {
        $contact = new Contact;
        $contacts = $contact -> getContacts();
        // Get the search query from the URL
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    
        // Handle empty query
        if (empty($query)) {
            echo json_encode(['errors' => 'Search query cannot be empty.']);
            exit;
        }
    
      
    
        // Filter data based on the query (case-insensitive)
        $results = array_filter($contacts, function ($item) use ($query) {
          return stripos($item['name'], $query) !== false || stripos($item['surname'], $query) !== false;
        });
    
        // Return JSON response
        echo json_encode(['results' => array_values($results)]);
        exit;
    }

}