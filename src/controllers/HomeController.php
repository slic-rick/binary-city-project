<?php

namespace Framework\Controllers;
use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;


class HomeController extends Controller{

    public function index() {

        $client = new Client();

         $clients =  $client -> getClients();

        $this->renderView('home/index', ['clients' => $clients]);
    }

}