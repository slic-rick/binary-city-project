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
				$clientId = $_POST['client_id'] ?? null;
                $contact_id = $_POST['contact_id'] ?? null;
			
		
				if ($clientId) {
					// Unlink the contact from the client
					$contact->unlinkContact($clientId,$contact_id);
				}
		
				// Redirect back to the contacts tab to avoid duplicate form submissions
				header("Location: /add-contact?tab=clients");
				exit;
			}

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['client_ids'])) {
            $clientIds = $_POST['client_ids']; // Array of selected contact IDs

            // Get the last insertedId
            $contactId = $contact->getlastInsertedId();
            $contact -> saveLinkedContact($_POST['client_ids'],$contactId);

            $contactClients = $contact -> getContactClients($contactId);

            $data['contactClients'] = $contactClients;

        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST)){
                $contact -> insert($_POST);
            }
        }

        $clients = $client -> getClients();

        $data['clients'] = $clients;

        $this->renderView('addContact/index', ['data' => $data]);
    }

}