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

//     public function getClients(){
//         // Also return the number of linkedcontacts from table CREATE TABLE `clientlinkcontact` (
// //   `clientId` varchar(255) NOT NULL,
// //   `contactId` varchar(255) NOT NULL,
// //   `id` int(11) NOT NULL
// // ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
//         $stmt = 'Select * FROM client';
//         $result = $this-> database -> query($stmt,[]);
//         return $result;
//     }


public function getClients() {
    // SQL to fetch clients and the count of linked contacts
    $stmt = '
        SELECT 
            c.id AS client_id,
            c.name,
            c.clientcode,
            COUNT(clc.contactId) AS linked_contacts_count
        FROM 
            client c
        LEFT JOIN 
            clientlinkcontact clc ON c.id = clc.clientId
        GROUP BY 
            c.id
    ';
    
    $result = $this->database->query($stmt, []);
    return $result;
}

    public function insert($data) {
        echo "<pre>";
        echo print_r($data);
        echo "</pre>";
        $keys = array_keys($data);

		$query = "insert into client (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		// show($query);
		$result = $this -> database ->query($query, $data);

        echo $result;
        return $result;

    }

    public function saveLinkedContact($contactIds,$clientId)  {
        // $data =  [];
        foreach ($contactIds as $key => $value) {
            $query = "insert into clientlinkcontact (clientId,contactId) values (:clientId, :contactId)";
            $data = array('contactId' => $value, 'clientId' => $clientId);
            $result = $this -> database ->query($query, $data);   
        }
    
    }

    public function clientCodeExists($clientCode)
    {
        $query = "SELECT * FROM client WHERE clientcode  = :clientCode LIMIT 1";
        $data = ['clientCode' => $clientCode];
        $result = $this -> database ->query($query, $data);
        return !empty($result);
    }


     public  function getlastInsertedId()  {
        return  $this -> database -> getLastSavedId();
        
    }

//    public function getClientContacts($clientId) {
//         $stmt = 'Select * FROM clientlinkcontact WHERE clientId = :clientId';
//         $data = ['clientId' => $clientId];
//         $result = $this-> database -> query($stmt,$data);
//         return $result;
//     }

    public function getClientContacts($clientId) {
        $stmt = '
        SELECT 
            c.id AS contact_id,
            c.name AS contact_name,
            c.surname AS contact_surname,
            c.email AS contact_email,
            clc.clientId AS client_id
        FROM 
            clientlinkcontact clc
        JOIN 
            contact c ON clc.contactId = c.id
        WHERE 
            clc.clientId = :clientId;
        ';
        
        $data = ['clientId' => $clientId];
        $result = $this->database->query($stmt, $data);
        
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


    public function unlinkContact($contactId, $clientId) {
        $stmt = '
            DELETE FROM clientlinkcontact 
            WHERE contactId = :contactId AND clientId = :clientId
        ';
        $data = [
            'contactId' => $contactId,
            'clientId' => $clientId
        ];
        return $this->database->query($stmt, $data);
    }
    
    
}