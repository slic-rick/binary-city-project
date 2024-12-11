<?php

namespace Framework\Controllers;

use Framework\Core\Controller;
use Framework\Models\Client;
use Framework\Core\Database;
use Framework\Models\Contact;

class EditContact extends Controller{

    public function index() {

        // get the passed contact here!
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";

        $client  = new Client;

        $contact = new Contact;

        $contactId = $_GET['contact'];
        $_SESSION['contactId'] = $contactId;

        $getContact = $contact -> getContact($contactId);

        // if(!empty($getContact)){
        //     $_SESSION
        // }

        // echo "<pre>";
        // print_r($getContact);
        // echo "</pre>";

        $savedContact = ['contact' => $getContact[0]];

        // echo "<pre>";
        // print_r($savedContact);
        // echo "</pre>";

        $clients = $client -> getClients();

        $data['clients'] = $clients;

        
        $this -> renderView('editContact/index',$savedContact);

    }

    public function updateContact()  {

        // before validation, store the data in the session

        $data = [];
        $contact = new Contact;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $formData = array("name" => $_POST['name'], "surname" => $_POST['surname'], "email" => $_POST['email']);

            $_SESSION['formData'] = $formData;

            // validate the data
            $sanitizedData = [
                'email' => $this->sanitizeInput($_POST['email']),
                'name' => $this->sanitizeInput($_POST['name']),
                'surname' => $this->sanitizeInput($_POST['surname']),
                'id' =>$_SESSION['contactId']
            ];
    
            // Validate the sanitized input
            $errors = $this->validate($sanitizedData, $contact);

            if(empty($errors)){
            // update the contact in the database

            $update = $contact -> updateContact($sanitizedData);


            // echo "<pre>";
            // print_r($update);
            // echo "</pre>";

            if($update){
                $data['success'] = 'successfully updated the contact';
            }else{
                $data['error'] = 'An error occurred';
            }
            // let the view now that we successfully updated the contact, so that we can show alert/dialog

            

            }else{
                $data = ['errors' => $errors];
            }

             $this -> renderView('editContact/index',$data);


        }

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
		// else if ($contact->isContactSaved($data['email'])) {
		// 	$errors['email'] = "The contact email is already saved!";
		// }

       // Add regex to validate email format
        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "The email address is not valid.";
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

}