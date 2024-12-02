<?php
 namespace Framework\Models;

 use Framework\Core\Database;

class Contact{

    private $database;

    public function __construct() {
        $this -> database = new Database();
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
        // $data =  [];
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
    
}