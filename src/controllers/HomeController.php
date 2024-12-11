<?php

namespace Framework\Controllers;
use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;


class HomeController extends Controller{

    public function index() {
        $_SESSION = [];
        $client = new Client();

         $clients =  $client -> getClients();

        $this->renderView('home/index', ['clients' => $clients]);
    }


    public function search()
    {
        $client = new Client();
        $clients =  $client -> getClients();
        // Get the search query from the URL
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    
        // Handle empty query
        if (empty($query)) {
            echo json_encode(['errors' => 'Search query cannot be empty.']);
            exit;
        }
    
      
    
        // Filter data based on the query (case-insensitive)
        $results = array_filter($clients, function ($item) use ($query) {
            return stripos($item['name'], $query) !== false;
        });
    
        // Return JSON response
        echo json_encode(['results' => array_values($results)]);
        exit;
    }
    

}