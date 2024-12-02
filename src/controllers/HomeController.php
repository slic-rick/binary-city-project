<?php

namespace Framework\Controllers;
use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;


class HomeController extends Controller{

    public function index() {

        $client = new Client();

         $clients =  $client -> getClients();

        //  echo "<pre>";
        //  print_r($users);
        //  echo "</pre>";
        
        // $users = [
        //     new User('John Doe', 'john@example.com'),
        //     new User('Jane Doe', 'jane@example.com')
        // ];

        $this->renderView('home/index', ['clients' => $clients]);
    }

}