<?php
 namespace Framework\Models;

 use Framework\Core\Database;

class Contact{

    private $database;

    public function __construct() {
        $this -> database = new Database();
    }

    public function getcontact($id){
       $query = "SELECT * FROM contact WHERE id = :id LIMIT 1";
       $data = ["id" => $id];
       $result = $this -> database -> query($query, $data); 

       return $result;
    }

    public function updateContact($contact) {
        $stmt = "UPDATE contact SET name=:name, surname=:surname,email=:email WHERE id =:id ";
        $result = $this -> database -> query($stmt,$contact);

        return $result;
    }


    public function getContacts() {
        /**
         * Get all contacts plus the number of linked clients.
         */
        $stmt = '
            SELECT 
                c.id AS contact_id,
                c.name,
                c.surname,
                c.email,
                COUNT(clc.clientId) AS linked_clients_count
            FROM 
                contact c
            LEFT JOIN 
                clientlinkcontact clc ON c.id = clc.contactId
            GROUP BY 
                c.id
            ORDER BY c.surname ASC;
        ';
        
        try {
            $result = $this->database->query($stmt, []); // Assuming a method to execute the query
            return $result;
        } catch (Exception $e) {
            // Log and handle any database errors
            error_log('Database error: ' . $e->getMessage());
            return false; // Or an empty array to indicate failure
        }
    }
    
    
    public function insert($data) {
        // echo "<pre>";
        // echo print_r($data);
        // echo "</pre>";
        $keys = array_keys($data);

		$query = "insert into contact (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		// show($query);
		$result = $this -> database ->query($query, $data);

        echo $result;
        return $result;

    }

    public function saveLinkedContact($clientIds,$contactId)  {
        foreach ($clientIds as $key => $value) {
            $query = "insert into clientlinkcontact (clientId,contactId) values (:clientId, :contactId)";
            $data = array('contactId' => $contactId, 'clientId' => $value);
            $result = $this -> database ->query($query, $data);
        }
    
    }

    public  function getlastInsertedId()  {
        return  $this -> database -> getLastSavedId();
        
    }

    public function getContactClients($contactId) {
        /**
         * Get the clients connected to the contactId.
         * Returns client name and client code.
         */
        
        $stmt = '
            SELECT 
                clc.clientId AS client_id,
                client.name AS client_name,
                client.clientcode AS client_code,
                clc.contactId AS contact_id

            FROM 
                clientlinkcontact clc
            JOIN 
                client ON clc.clientId = client.id
            WHERE 
                clc.contactId = :contactid;
        ';
        
        $data = ['contactid' => $contactId];
        
        try {
            $result = $this->database->query($stmt, $data); // Assuming `$this->database->query` is your DB abstraction.
            return $result;
        } catch (Exception $e) {
            // Log or handle exceptions
            error_log('Database error: ' . $e->getMessage());
            return false; // Or handle appropriately
        }
    }

    public function unlinkContact($clientId,$contactId) {

        $stmt = '
        DELETE FROM clientlinkcontact 
        WHERE contactId = :contactId AND clientId = :clientId';
        $data = [
            'contactId' => $contactId,
            'clientId' => $clientId
        ];
         return $this->database->query($stmt, $data);
        
    }

    public function isContactSaved($contactEmail) {
        // SQL query to check if the client exists
        $stmt = '
            SELECT 
                id
            FROM 
                contact 
            WHERE 
                email = :contactEmail
            LIMIT 1
        ';
    
        // Execute the query with the provided client name
        $result = $this->database->query($stmt, [
            ':contactEmail' => $contactEmail
        ]);
    
        // Check if any rows were returned
        if (!empty($result)) {
            // return $result[0]; // Return the first matching row
            return true;
        }
    
        // Return false if no match was found
        return false;
    }

    public function deleteAllLinkedClients($contactId)  {

        $stmt = ' DELETE FROM clientlinkcontact 
        WHERE contactId = :contactId';

        $data = ['contactId' => $contactId];
        $result = $this -> database -> query($stmt,$data);

        return $result;
    }
    
}