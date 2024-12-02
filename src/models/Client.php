<?php
 namespace Framework\Models;

 use Framework\Core\Database;

class Client{


    private $database;
    public $name;
    public $clientCode;

    public function __construct() {
        $this -> database = new Database();
    }

    public function getClients(){
        $stmt = 'Select * FROM client';
        $result = $this-> database -> query($stmt,[]);
        return $result;
    }


    public function insert($data) {
        $keys = array_keys($data);

		$query = "insert into client (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		// show($query);
		$result = $this -> database ->query($query, $data);

        echo $result;
    }

    public function clientCodeExists($clientCode)
    {
        $query = "SELECT * FROM client WHERE clientcode  = :clientCode LIMIT 1";
        $data = ['clientCode' => $clientCode];
        $result = $this -> database ->query($query, $data);
        return !empty($result);
    }


     public  function getlastInsertedId()  {
        $con =  $this -> database -> connect();
        return  $con->lastInsertId();
        
    }

   public function getClientContacts($clientId) {
        $stmt = 'Select * FROM clientlinkcontact WHERE clientId = :clientId';
        $data = ['clientId' => $clientId];
        $result = $this-> database -> query($stmt,$data);
        return $result;
    }

    public function getAllContacts() {
        // Join clientlinkcontact and contact tables to fetch contact details
        $stmt = '
        SELECT 
            c.id AS contact_id,
            c.name AS contact_name,
            c.surname AS contact_surname,
            c.email AS contact_email
        FROM 
            clientlinkcontact clc
        JOIN 
            contact c ON clc.contactId = c.id;
    ';
    
        $result = $this->database->query($stmt, []);
    
        return $result;
    }
    
}