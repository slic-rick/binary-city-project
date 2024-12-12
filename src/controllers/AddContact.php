<?php
namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Contact;
use Framework\Models\Client;
use Framework\Core\Database;

class AddContact extends Controller {


    public function index() {

        $data = [];
        $contact = new Contact;
        $client = new Client;

        // Handle unlink contact request
		// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unlink_client') {
		// 		// Validate input
		// 		$clientId = $_POST['client_id'];
        //         $contact_id = $_SESSION['contact_id'];

		// 		if ($clientId && $contact_id) {
		// 			// Unlink the contact from the client
		// 			$contact->unlinkContact($clientId,$contact_id);

        //             $contactClients = $contact -> getContactClients($contact_id);
        //             $data['contactClients'] = $contactClients;
		// 		}else{
        //             // echo "The client id and contact_id is empty";
        //         }
		
				
		// 	}

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_ids'])) {

            // echo "We can save the contact clients";
            // $clientIds = $_POST['client_ids']; // Array of selected contact IDs

            // $contactId = $_POST['contact_id'] ?? $_SESSION['contact_id'] ?? null;


            // if(isset($contactId)){
            //     $contact -> saveLinkedContact($_POST['client_ids'],$contactId);
            //     $contactClients = $contact -> getContactClients($contactId);
            //     $data['contactClients'] = $contactClients;
            // }else {
            //     echo "Contact id Is empty";
            // }

            $this -> linkClients();

      



        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this ->saveContact();
        }
        

        $clients = $client -> getClients();

        $data['clients'] = $clients;

        $this->renderView('addContact/index', ['data' => $data]);
    }

    private function validate($data, $contact)
    {
        $errors = array();
    
        // Check if name is empty
        if (empty($data['name'])) {
            $errors['name'] = "Name is required.";
        } 
        // Check if name is too short
        if (strlen($data['name']) < 3) {
            $errors['name'] = "The name is too short.";
        }
    
        // Check if surname is empty
        if (empty($data['surname'])) {
            $errors['surname'] = "Surname is required.";
        }
        // Check if surname is too short
        if (strlen($data['surname']) < 3) {
            $errors['surname'] = "The surname is too short.";
        }
    
        // Check if email is empty
        if (empty($data['email'])) {
            $errors['email'] = "Email is required!";
        }
        // Check if the contact email already exists
        else if ($contact->isContactSaved($data['email'])) {
            $errors['email'] = "The contact email is already saved!";
        }
        // Validate email format
        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "The email address is not valid.";
        }
    
        return $errors;
    }

    public function unlinkClient() {
        
        $response['success'] = false;

		$clientId = $_POST['client_id'];
		$contactId = $_SESSION['contact_id'];

		if (isset($contactId) && isset($clientId)) {

			$contact = new Contact;
			$unlinkSuccess = $contact->unlinkContact($clientId,$contactId);
			$response['success'] = true;
	
		} else {
			$response['message'] = "Invalid contact ID.";
		}
	
		echo json_encode($response);
        
    }

    private function linkClients() {

        $response['success'] = false;
        $contact = new Contact;

        $clientIds = $_POST['client_ids']; // Array of selected contact IDs
        $contactId =$_SESSION['contact_id'] ?? $_POST['contact_id'] ?? null;


        if(isset($contactId)){

            // check if the user has linked clints and delete them

            
            $contactClients = $contact -> getContactClients($contactId);

					if(!empty($contactClients)){

						// delete all linked contacts
						$deleteLinkedContacts = $contact -> deleteAllLinkedClients($contactId);

					}

            $contact -> saveLinkedContact($_POST['client_ids'],$contactId);
            $contactClients = $contact -> getContactClients($contactId);

            $response['success'] = true;
            $response['contactClients'] = $contactClients;

        }

        echo json_encode($response);
        exit();

  


    }

    public function getClients(){

        $response['success'] = false;
        $client = new Client;

        $clients = $client -> getClients();

        if(!empty($clients)){
            $response['success'] = true;
            $response['clients'] = $clients;
        }

        echo json_encode($response);
        exit();

        
        
    }

    public function getLinkedClients(){
        $contact = new Contact;
        $response['success'] = false;
        $contact_id = $_SESSION['contact_id'];

        if(isset($contact_id)){

            $linked = $contact -> getContactClients($contact_id);

                $response['success'] = true;
                $response['linkedClients'] = $linked ?: []; ;

            

        }

        echo json_encode($response);
        exit();
    }


    //  $router-> addRoute('/get-clients',AddContact::class,'getClients');

    // $router-> addRoute('/get-linked-clients',AddContact::class,'getLinkedClients');
    

    private function saveContact(){
        $response['success'] = false; 
        if (!empty($_POST)) {

            $contact = new Contact;
        
            // Sanitize inputs
            $sanitizedData = [
                'email' => $this->sanitizeInput($_POST['email']),
                'name' => $this->sanitizeInput($_POST['name']),
                'surname' => $this->sanitizeInput($_POST['surname']),
            ];
    
            // Validate the sanitized input
            $errors = $this->validate($sanitizedData, $contact);
    
            if (empty($errors)) {
                $contactId = rand(10000000, 99999999);
    
                $saveContact = array(
                    'id' => $contactId,
                    'email' => $sanitizedData['email'],
                    'name' => $sanitizedData['name'],
                    'surname' => $sanitizedData['surname']
                );
    
                $contact->insert($saveContact);
    
                // Save contact details to session
                $_SESSION['contact_id'] = $contactId;
                // $_SESSION['contact'] = $saveContact;
                $response['success'] = true; 

                $response['contact'] = $saveContact; 

            } else {
                // Handle validation errors
                $response['errors'] = $errors;
            }
        }

        echo json_encode($response);
        exit();
    }


    private function sanitizeInput($input) {
        // Trim the input
        $input = trim($input);
    
        // Remove HTML and PHP tags
        $input = strip_tags($input);
    
        // Convert special characters to HTML entities
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
        return $input;
    }
    

}