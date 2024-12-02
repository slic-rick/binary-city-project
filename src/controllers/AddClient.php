<?php
namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;

class AddClient extends Controller {


    public function index() {
       	  $data = [];
		  $client = new Client;

		          // Check if form data exists
				  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['contact_ids'])) {
					$contactIds = $_POST['contact_ids']; // Array of selected contact IDs
					$clientId = $_POST['client_id']; // Ensure this is passed with the form

					echo "<pre>";
					echo print_r($_POST['contact_ids']);
					echo "</pre>";
		
					// // Insert each contact-client link into the database
					// $stmt = 'INSERT INTO clientlinkcontact (clientId, contactId) VALUES (:clientId, :contactId)';
					// foreach ($contactIds as $contactId) {
					// 	$this->database->query($stmt, [
					// 		':clientId' => $clientId,
					// 		':contactId' => $contactId,
					// 	]);
					// }
				}

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            // Validate the data before saving to database!
          

			// Validate form input
			$errors = $this->validate($_POST);

            if (empty($errors)) {
				// Generate client code
				$clientCode = $this->generateClientCode($_POST['name']);
				$_POST['clientCode'] = $clientCode;

				// Insert client data
				$client->insert($_POST);

                // On success -> go to back and show the second tab!

                // echo "inserted user";

				// Get the last inserted client ID
				// $clientId = $client->getLastInsertedId();

				// show($clientId);

				// if (isset($_POST['contacts']) && is_array($_POST['contacts'])) {
				// 	$contacts_id = $_POST['contacts'];

				// 	$contactClient = new ContactClients;
				// 	foreach ($contacts_id as $id) {
				// 		$client_contact = [
				// 			'contactId' => $id,
				// 			'clientId' => $clientId
				// 		];
				// 		//show($client_contact);
				// 		$contactClient->insert($client_contact);

				// 		// update the counter for the number of linked contacts
				// 		$client->incrementLinkedContactsCount($clientId);
				// 	}
				// }

				// Redirect to a success page or another appropriate page
				// header('Location: /'); // Change the URL to your success page
				// exit;
				header("Location: /add-client?tab=contacts");
				exit;
			} else {
				$data['errors'] = $errors;
				// $data['name'] = $_POST['name'];
				// $data['email'] = $_POST['email'];
			}

        }

		
		$contacts = $client -> getAllContacts();



		
		$data['contacts'] = $contacts;

		echo "<pre>";
		echo print_r($data);
		echo "</pre>";


		// if($clientId){
		// 	//  get the clients contacts

		// }

        $this->renderView('addClient/index', ['data' => $data]);
    }

    private function validate($data)
	{
        // echo "<pre>";
        // echo print_r($data);
        // echo "</pre>";
       
		$errors = [];

		if (empty($data['name'])) {
			$errors[] = "Name is required.";
		}

		// Additional validation rules can be added here

		return $errors;
	}

    private function generateClientCode($clientName)
	{
		$clientName = strtoupper($clientName);
		$prefix = substr($clientName, 0, 3);

		// If the client name is shorter than 3 characters, pad with additional characters
		if (strlen($prefix) < 3) {
			$prefix = str_pad($prefix, 3, 'A');
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