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
            ORDER BY
                c.name ASC
        ';
        
        $result = $this->database->query($stmt, []);
        return $result;
    }

    public function getClientName($clientName) {
        // SQL query to check if the client exists
        $stmt = '
            SELECT 
                id, 
                name 
            FROM 
                client 
            WHERE 
                name = :clientName
            LIMIT 1
        ';
    
        // Execute the query with the provided client name
        $result = $this->database->query($stmt, [
            ':clientName' => $clientName
        ]);
    
        // Check if any rows were returned
        if (!empty($result)) {
            // return $result[0]; // Return the first matching row
            return true;
        }
    
        // Return false if no match was found
        return false;
    }
    

    public function insert($data) {
        $keys = array_keys($data);

		$query = "insert into client (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		$result = $this -> database ->query($query, $data);

        // return the id of the last inserted document or return the doc itself.
        $lastId = $this->database->getLastSavedId();
        return $lastId;

    }

    public function saveLinkedContact($contactIds,$clientId)  {
        // $data =  [];
        foreach ($contactIds as $key => $value) {
            $query = "insert into clientlinkcontact (clientId,contactId) values (:clientId, :contactId)";
            $data = array('clientId' => $clientId,'contactId' => $value,);
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

         $lastInsert =  $this -> database -> getLastSavedId();

         echo "<pre>";
         echo print_r($lastInsert);
         echo "</pre>";

         return $lastInsert;
        
    }

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

        $stmt = 'SELECT * FROM contact';
    
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