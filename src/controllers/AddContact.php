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

                echo "<pre>";
                echo print_r($contact_id);
                echo print_r($clientId);
                echo "</pre>";
		
				if ($clientId && $contact_id) {
					// Unlink the contact from the client
					$contact->unlinkContact($clientId,$contact_id);

                    $contactClients = $contact -> getContactClients($contact_id);
                    $data['contactClients'] = $contactClients;
				}
		
				// Redirect back to the contacts tab to avoid duplicate form submissions
				header("Location: /add-contact?tab=clients");
				exit;
			}

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_ids'])) {

            // echo "<pre>";
            // echo print_r($_SESSION['contact_id']);
            // echo "</pre>";

            echo "We can save the contact clients";
            $clientIds = $_POST['client_ids']; // Array of selected contact IDs

            $contactId = $_POST['contact_id'] ?? $_SESSION['contact_id'] ?? null;

            echo "<pre>";
            echo print_r($contactId);
            echo "</pre>";

            if(isset($contactId)){
                $contact -> saveLinkedContact($_POST['client_ids'],$contactId);
                $contactClients = $contact -> getContactClients($contactId);
                $data['contactClients'] = $contactClients;
            }else {
                echo "Contact id Is empty";
            }

            // header("Location: /add-contact?tab=clients&contact=$contactId");



        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST)){
                $contactId = rand(10000000, 99999999);

                $saveContact = array('id' => $contactId, 'email' => $_POST['email'], 'name' => $_POST['name'], 'surname' => $_POST['surname']);

            

                $contact -> insert($saveContact);

                // if($contact){
                $_SESSION['contact_id'] = $contactId;

                header("Location: /add-contact?tab=clients&contact=$contactId");

                // }
            }
        }

        $clients = $client -> getClients();

        $data['clients'] = $clients;

        $this->renderView('addContact/index', ['data' => $data]);
    }

}