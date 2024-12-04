<?php
namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;

class AddClient extends Controller {


    public function index() {

       	  $data = [];
		  $client = new Client;

			// Handle unlink contact request
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unlink_contact') {

				// Validate input
				$contactId = $_POST['contact_id'] ?? null;
				$clientId = $_POST['client_id'] ?? $_SESSION['client_id'];

				if ($contactId && $clientId) {


					// Unlink the contact from the client
					$client->unlinkContact($contactId, $clientId);

					$clientContacts = $client -> getClientContacts($clientId);

					$data['clientContacts'] = $clientContacts;
				}

				// Redirect back to the contacts tab to avoid duplicate form submissions
				// header("Location: /add-client?tab=contacts");
				// exit;
			}

		 // Check if form data exists
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['contact_ids'])) {

						$contactIds = $_POST['contact_ids']; // Array of selected contact IDs

						// // Get the last insertedId
						// $clientId = $client->getlastInsertedId();
						$clientId = $_POST['client_id'] ?? $_SESSION['client_id'] ?? null;// Retrieve the 'client' parameter from the URL	
					
						// echo "The client ID is: " . $clientId;

						if(isset($clientId)){

							$client -> saveLinkedContact($_POST['contact_ids'],$clientId);
							$clientContacts = $client -> getClientContacts($clientId);
	
							$data['clientContacts'] = $clientContacts;

						}else{
							echo "client id Not set";
						}
			}

			if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name'])) {

				// Sanitize inputs
				$name = $this->sanitizeInput($_POST['name']);
			
				// Validate form input
				$errors = $this->validate(['name' => $name], $client);
			
				if (empty($errors)) {
					// Generate client code
					$clientCode = $this->generateClientCode($name);
			
					// Generate a random 8-digit number (you can adjust this as needed)
					$saveClientId = rand(10000000, 99999999);
			
					$newClient = array(
						'name' => $name,
						'clientCode' => $clientCode,
						'id' => $saveClientId
					);
			
					// Insert client data
					$result = $client->insert($newClient);
			
					$_SESSION['client_id'] = $saveClientId;
					$_SESSION['client'] = $newClient;
			
					// If the client got inserted, then get all the clients
					if ($result) {
						$clientContacts = $client->getClientContacts($saveClientId);
						$data['clientContacts'] = $clientContacts;
					}
			
					$data['client_id'] = $saveClientId;
			
					header("Location: /add-client?tab=contacts&client=$saveClientId");
					exit;
				} else {
					$data['errors'] = $errors;
				}
			}
			

		
				$contacts = $client -> getAllContacts();

				$data['contacts'] = $contacts;



		// Get clientContacts

        $this->renderView('addClient/index', ['data' => $data]);
    }

	private function validate($data, $client)
	{
		$errors = [];
	
		// Debugging validation process
		// echo "Validating the form...";
	
		// Check if name is empty
		if (empty($data['name'])) {
			$errors[] = "Name is required.";
		} 
		// Check if name is too short
		// else if (strlen($data['name']) < 3) {
		// 	$errors[] = "The name is too short.";
		// } 
		// Check if the client already exists
		else if ($client->getClientName($data['name'])) {
			$errors[] = "The client is already saved!";
		}
	
		return $errors;
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
	
	

    // private function generateClientCode($clientName)
	// {
	// 	$clientName = strtoupper($clientName);
	// 	$prefix = substr($clientName, 0, 3);

	// 	// If the client name is shorter than 3 characters, pad with additional characters
	// 	if (strlen($prefix) < 3) {
	// 		$prefix = str_pad($prefix, 3, 'A');
	// 	}

	// 	// Ensure the prefix is exactly 3 characters long
	// 	$prefix = substr($prefix, 0, 3);

	// 	$client = new Client;
	// 	$counter = 1;
	// 	do {
	// 		$numericPart = str_pad($counter, 3, '0', STR_PAD_LEFT);
	// 		$clientCode = $prefix . $numericPart;
	// 		$counter++;
	// 	} while ($client->clientCodeExists($clientCode));

	// 	return $clientCode;
	// }


	private function generateClientCode($clientName) {
		$clientName = strtoupper($clientName);
	
		// Split the name into words
		$words = explode(' ', $clientName);
	
		// Handle different name lengths
		if (count($words) >= 3) {
			// Take the first letter of each of the first 3 words
			$prefix = substr($words[0], 0, 1) . substr($words[1], 0, 1) . substr($words[2], 0, 1);
		} else {
			// Pad shorter names with 'A'
			$prefix = str_pad(substr($clientName, 0, 3), 3, 'A');
		}
	
		// Ensure the prefix is exactly 3 characters long
		$prefix = substr($prefix, 0, 3);
	
		$client = new Client;
		$counter = 1;
		do {
			$numericPart = str_pad($counter, 3, '0', STR_PAD_LEFT);
			$clientCode = $prefix . $numericPart;
			$counter++;
		} while ($client->clientCodeExists($clientCode));
	
		return $clientCode;
	}
	
}