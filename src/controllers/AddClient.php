<?php
namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;

class AddClient extends Controller {

	

    public function index() {

       	  $data = [];
		  $client = new Client;

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['contact_ids'])) {
			$this -> saveLinkedContacts();
		}else if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$this -> insertClient();
		}
			

		
		$contacts = $client -> getAllContacts();

		$data['contacts'] = $contacts;



		// Get clientContacts

        $this->renderView('addClient/index', ['data' => $data]);
    }

	public function unlinkContact() {

		$response['success'] = false;

		$clientId = $_SESSION['client_id'];
		$contactId = $_POST['contact_id'];

		if (isset($contactId) && isset($clientId)) {

			$client = new Client;
			$unlinkSuccess = $client->unlinkContact($contactId,$clientId);
			$response['success'] = true;
			


		} else {
			$response['message'] = "Invalid contact ID.";
		}
	
		echo json_encode($response);
	}
	

	private function saveLinkedContacts(){
			 // Check if form data exists
				$client = new Client;

				$response['success'] = false;
				$contactIds = $_POST['contact_ids']; // Array of selected contact IDs

				//save

				$clientId =  $_SESSION['client_id'] ?? $_POST['client_id'] ?? null; // Retrieve the 'client' parameter from the URL	
			

				if(isset($clientId)){

					// Check if the user has any linked contacts

					$linkedContacts = $client -> getClientContacts($clientId);

					if(!empty($linkedContacts)){

						// delete all linked contacts
						$deleteLinkedContacts = $client -> deleteAllLinkedContacts($clientId);

					}

					$client -> saveLinkedContact($_POST['contact_ids'],$clientId);
					$clientContacts = $client -> getClientContacts($clientId);

					$response['success'] = true;
					$response['linkedContacts'] = $clientContacts;


				}else{
					echo "client id Not set";
				}
				echo json_encode($response);
				exit();
			

	}

	public function getLinkedContacts() {
		$client = new Client;
		$response = ['success' => false, 'linkedContacts' => []]; // Default response structure
		$clientId = $_SESSION['client_id'];
	
		if (isset($clientId)) {
			$linkedContacts = $client->getClientContacts($clientId);
	
			$response['success'] = true; // Indicate the request was successful
			$response['linkedContacts'] = $linkedContacts ?: []; // Ensure an empty array if no linked contacts
		}
	
		echo json_encode($response);
		exit();
	}
	

	public function getContacts() {
		$client = new Client;
		$response['success'] = false;

		$contacts = $client -> getAllContacts();

		if(!empty($contacts)){
			$response['success'] = true;
			$response['contacts'] = $contacts;
		}

		echo json_encode($response);
	}

	private function validate($data, $client)
	{
		$errors = [];
	
		// Check if name is empty
		if (empty($data['name'])) {
			$errors['name'] = "Name is required.";
		} 
		// Check if the client already exists
		else if ($client->getClientName($data['name'])) {
			$errors['name'] = "The client is already saved!";
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
	
	
	private function insertClient()
	{
		$response = ['success' => false];
		$client = new Client;
	
		// Sanitize inputs
		$name = $this->sanitizeInput($_POST['name']);
	
		// Validate form input
		$errors = $this->validate(['name' => $name], $client);
	
		if (empty($errors)) {
			// Generate client code
			$clientCode = $this->generateClientCode($name);
	
			// Generate a random 8-digit number (you can adjust this as needed)
			$saveClientId = rand(10000000, 99999999);
	
			$newClient = [
				'name' => $name,
				'clientCode' => $clientCode,
				'id' => $saveClientId,
			];
	
			// Insert client data
			$result = $client->insert($newClient);
	
			$_SESSION['client_id'] = $saveClientId;
			// $_SESSION['client'] = $newClient;
	
			if ($result) {
				$response['success'] = true;
				$response['client'] = $newClient;
			} else {
				$response['message'] = 'Failed to save client.';
			}
		} else {
			$response['errors'] = $errors; // Return field-specific errors
		}
	
		header('Content-Type: application/json');
		echo json_encode($response);
		exit();
	}
	

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