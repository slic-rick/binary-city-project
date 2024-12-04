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
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unlink_client') {
				// Validate input
				$clientId = $_POST['client_id'];
                $contact_id = $_SESSION['contact_id'];

                // echo "<pre>";
                // echo print_r($contact_id);
                // echo print_r($clientId);
                // echo "</pre>";
		
				if ($clientId && $contact_id) {
					// Unlink the contact from the client
					$contact->unlinkContact($clientId,$contact_id);

                    $contactClients = $contact -> getContactClients($contact_id);
                    $data['contactClients'] = $contactClients;
				}else{
                    // echo "The client id and contact_id is empty";
                }
		
				
			}

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_ids'])) {

            // echo "We can save the contact clients";
            $clientIds = $_POST['client_ids']; // Array of selected contact IDs

            $contactId = $_POST['contact_id'] ?? $_SESSION['contact_id'] ?? null;


            if(isset($contactId)){
                $contact -> saveLinkedContact($_POST['client_ids'],$contactId);
                $contactClients = $contact -> getContactClients($contactId);
                $data['contactClients'] = $contactClients;
            }else {
                echo "Contact id Is empty";
            }

      



        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST)){

                $errors = $this -> validate($_POST,$contact);

                if(empty($errors)){

                    $contactId = rand(10000000, 99999999);

                    $saveContact = array('id' => $contactId, 'email' => $_POST['email'], 'name' => $_POST['name'], 'surname' => $_POST['surname']);

                    $contact -> insert($saveContact);

                    // if($contact){
                    $_SESSION['contact_id'] = $contactId;

                    $_SESSION['contact'] = $saveContact;

                    header("Location: /add-contact?tab=clients&contact=$contactId");

                }else{
                    // The form has some errors
             
                    $data['errors'] = $errors;
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                }

            }
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
		else if (strlen($data['name']) < 3) {
			$errors['name'] = "The name is too short.";
		}
        else if (empty($data['surname'])) {
			$errors['surname'] = "Surname is required.";
		} 
		// Check if name is too short
		else if (strlen($data['surname']) < 3) {
			$errors['surname'] = "The name is too short.";
		} 
        else if (empty($data['email']) ) {
			$errors['email'] = "Email is required!";
		}
		// Check if the contact email already exists
		else if ($contact->isContactSaved($data['email'])) {
			$errors['email'] = "The contact email is already saved!";
		}

       // Add regex to validate email format
        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "The email address is not valid.";
        }
	
		return $errors;
	}

}