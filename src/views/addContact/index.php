<?php   include "partials/_header.php"; ?>




    <div class="col-8">

        <main class="main container" id="main">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/contacts">Contacts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Contact</li>
            </ol>
            </nav>
        <h1>Create new contact</h1>
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="addClientTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link disabled" id="clients-tab" type="button" role="tab" aria-controls="clients" aria-selected="false">Clients</button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content p-3 border border-top-0" id="addClientTabsContent">
    <!-- General Tab -->
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <form id="generalForm" class="needs-validation" method="POST" novalidate>
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    class="form-control"  
                    id="name" 
                    name="name" 
                    placeholder="Enter contact name"  >
               
                    <div class="invalid-feedback" id="nameError">
                    </div>
               
            </div>

            <!-- Surname Field -->
            <div class="mb-3">
                <label for="surname" class="form-label">Surname</label>
                <input 
                    type="text" 
                    class="form-control"  
                    id="surname" 
                    name="surname" 
                    placeholder="Enter contact surname" >
                
                    <div class="invalid-feedback" id="surnameError">
                    
                    </div>
                
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control"  
                    id="email" 
                    name="email" 
                    placeholder="Enter client email" >
             
                    <div class="invalid-feedback" id="emailError">
                    </div>
              
                </div>
                   

            <button type="submit" class="btn btn-primary" id="nextTBtn" >Next</button>
        </form>
    </div>


                <!-- Contacts Tab -->
                <div class="tab-pane fade" id="clients" role="tabpanel" aria-labelledby="clients-tab">
                    <div>
                        <table id="clients_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Client Code</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                           
                    <tr id="no_clients">
                        <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No clients linked!</td>
                    </tr>
 <!--            
                        <tr>
                             
                            <td></td>
                            <td></td>
                            <td>
                                <form method="POST" action="/add-contact">
                                    <input type="hidden" name="action" value="unlink_client">
                                    <input type="hidden" name="client_id" value=""> 
                                    <button type="submit" class="btn btn-danger btn-sm unlink-contact-btn">Unlink</button>
                                </form>
                            </td> -->
                        <!-- </tr> -->
              
                    
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#linkClientsModal" id="linkContactsButton">Link Clients</button>
                        <button class="btn btn-primary me-md-2" type="button" onclick="window.location.href='/contacts';">Save</button>
                        <!-- <button class="btn btn-primary" type="button">Button</button> -->
                    </div>
                </div>
            </div>

            <!-- Link Clients Modal -->
            <div class="modal fade" id="linkClientsModal" tabindex="-1" aria-labelledby="linkClientsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="linkClientsModalLabel">Link Contacts</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="linkClientForm" action="add-contact" method="POST">
                            <!-- <input type="hidden" name="contact_id" value="" /> -->
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" id="selectAll" />
                                            </th>
                                            <!-- <th scope="col">#</th> -->
                                            <th scope="col">Name</th>
                                            <th scope="col">Client Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    
                                  
                                    
                                
                                            <!-- <tr>
                                                    <td><input type='checkbox' name='client_ids[]' class='contact-checkbox'/></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr> -->
                                        
                                       
                                    </tbody>
                                </table>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="linkContactsSubmitBtn">Save</button>
                                </div>
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMessage"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
              </div>
            </div>

        </main>
    </div>

    </div>
        </div>
            </div>
        </div>

    <?php   include "partials/_scripts.php"; ?>


<script>

    document.addEventListener("DOMContentLoaded", function () {
        const selectAllCheckbox = document.getElementById("selectAll");
        // Logic for saving  and validating the form
        document.getElementById("nextTBtn").addEventListener("click", async (event) => {
         event.preventDefault(); // Prevent the form from submitting

        const formData = new FormData(document.getElementById("generalForm"));

        try {
            console.log('Form data is', formData);

            // Send form data to the server
            const response = await fetch('/add-contact', {  // Update the URL to match your server endpoint
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json', // Expecting a JSON response
                },
            });

            const result = await response.json();
            console.log('The result is', result);

            // Clear previous error states
            const nameInput = document.getElementById("name");
            const surnameInput = document.getElementById("surname");
            const emailInput = document.getElementById("email");

            const nameError = document.getElementById("nameError");
            const surnameError = document.getElementById("surnameError");
            const emailError = document.getElementById("emailError");

            // Clear error messages and remove invalid styling
            nameError.textContent = "";
            surnameError.textContent = "";
            emailError.textContent = "";

            nameInput.classList.remove("is-invalid");
            surnameInput.classList.remove("is-invalid");
            emailInput.classList.remove("is-invalid");

            // Remove any previous valid styling
            // nameInput.classList.remove("is-valid");
            // surnameInput.classList.remove("is-valid");
            // emailInput.classList.remove("is-valid");

            // Check if the response was successful
            if (result.success) {
                showToast("Contact added successfully!");

                // Navigate to the next tab
                // Activate the Clients tab
                const clientsTab = document.getElementById("clients-tab");
                clientsTab.classList.remove("disabled");
                clientsTab.setAttribute("data-bs-toggle", "tab");
                clientsTab.setAttribute("data-bs-target", "#clients");

                const tabTrigger = new bootstrap.Tab(clientsTab);
                tabTrigger.show();

            } else if (result.errors) {

                /**
                 * if (result.errors.name) {
                            nameError.textContent = result.errors.name;
                            nameInput.classList.add("is-invalid");
                        }
                */
                // Set the error messages if any
                if (result.errors.name) {
                    nameError.textContent = result.errors.name;
                    nameInput.classList.add("is-invalid");
                }
                if (result.errors.surname) {
                    surnameError.textContent = result.errors.surname;
                    surnameInput.classList.add("is-invalid");
                }
                if (result.errors.email) {
                    emailError.textContent = result.errors.email;
                    emailInput.classList.add("is-invalid");
                }
            }

        } catch (error) {
            console.error("Error:", error);
        }
        });

        /**
         * THE LOGIC FOR LINKING AND UNLINKING THE CONTACT
         */

         // Handle the click event for "Link Contact"
        document.getElementById('linkContactsButton').addEventListener("click", async () => {
            try {
                console.log('clicked Link client');
                
                // Fetch all contacts
                const clientsResponse = await fetch('/get-clients');
                const clientsData = await clientsResponse.json();

                console.log('ClientsData',clientsData);
                

                // Fetch linked contacts for the current client
                const linkedResponse = await fetch('/get-linked-clients');
                const linkedData = await linkedResponse.json();

                console.log('linkedData',linkedData);


                if (clientsData.success && linkedData.success) {
                    const tableBody = document.querySelector("#linkClientsModal .table tbody");
                    tableBody.innerHTML = ''; // Clear the table

                    const linkedClients = linkedData.linkedClients || []; // Fallback to empty array

                    // Populate the modal table with all contacts
                    clientsData.clients.forEach(client => {

                        const isChecked = linkedClients.some(
                            linkedClient => linkedClient.client_id === client.client_id
                        );

                        console.log('Checked is: ',isChecked);
                        
                      
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><input type="checkbox"  name='client_ids[]' class="client-checkbox" value="${client.client_id}" ${isChecked ? 'checked' : ''} /></td>
                            <td>${client.name}</td>
                            <td>${client.clientcode}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            } catch (error) {
                console.error("Error fetching contacts:", error);
            }
        });

        // Handle the linking of contacts when form is submitted
        document.getElementById('linkContactsSubmitBtn').addEventListener("click", async (event) => {

            event.preventDefault();

            const form = document.getElementById("linkClientForm");
            const formData = new FormData(form);

            try {

                const response = await fetch(form.action, {
                            method: form.method,
                            body: formData
                        });

                // const rawText = await response.text();
                // console.log('Raw data',rawText);
                

                const result = await response.json();

                console.log("RESULT",result);
                

                if (result.success) {  
                    // Hide the modal
                    const modalElement = document.getElementById("linkClientsModal");
                    const modalInstance = bootstrap.Modal.getInstance(modalElement); // Get the active instance
                    if (modalInstance) {
                        modalInstance.hide(); // Hide the modal
                    }

                    // Show the linked contacts in the table
                    const clientListTable = document.querySelector('#clients_table tbody');
                    console.log('Client table',clientListTable);
                    
                            clientListTable.innerHTML = ''; // Clear existing rows

                            // hide the no clients tr if we linked clients.
                            if(result.contactClients.length > 0){

                                const noClients = document.getElementById("no_clients");
                                // add the style display:none to the tr
                                if (noClients) {
                                    noClients.style.display = "none"; // Hide the "no contacts" row
                                }
                            }

                            result.contactClients.forEach(client => {
                                console.log('Created row');
                                
                                const row = document.createElement('tr');

                                row.innerHTML = `
                                <td style="display:none">${client.client_id}</td>
                                <td>${client.client_name}</td>
                                <td>${client.client_code}</td>
                                <td><button class="btn btn-danger btn-sm unlink-client-btn" data-client-id="${client.client_id}">Unlink</button></td> `;
                                


                                clientListTable.appendChild(row);

                                
                            });
                            console.log('AFTERLOOP::Client table',clientListTable);

                            showToast("Client linked successfully!");

                            // Automatically tick selected contacts on re-open
                            result.contactClients.forEach(client => {
                                const checkbox = document.querySelector(`input[value="${client.client_id}"]`);
                                if (checkbox) {
                                    checkbox.checked = true;
                                }
                            });
                }else{
                    console.error("Error linking clients:", result.message);

                } 

            } catch (error) {
                console.error("Error saving clients:", error);

            }



            // const selectedContacts = [];
            // const checkboxes = document.querySelectorAll(".contact-checkbox:checked");

            // checkboxes.forEach(checkbox => {
            //     selectedContacts.push(checkbox.value); // Store selected contact IDs
            // });

            // if (selectedContacts.length > 0) {
            //     try {
            //         const formData = new FormData();
            //         formData.append("action", "link_client"); // Add the action to identify the request
            //         formData.append("contact_ids", JSON.stringify(selectedContacts)); // Send selected contact IDs

            //         const response = await fetch('/link-contacts', {
            //             method: 'POST',
            //             body: formData,
            //         });

            //         const result = await response.json();
            //         if (result.success) {
            //             alert("Contacts linked successfully!");
            //             // Optionally, reload the contact list or update UI here
            //         } else {
            //             alert("Failed to link contacts.");
            //         }
            //     } catch (error) {
            //         console.error("Error linking contacts:", error);
            //     }
            // } else {
            //     alert("Please select at least one contact to link.");
            // }
        });

        
        // Function to handle unlinking a contact
        async function unlinkContact(clientId, rowElement) {
            try {
                const response = await fetch('unlink-client', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ client_id: clientId }).toString(),});

                const result = await response.json();

                if (result.success) {
                    // Remove the row from the table
                    rowElement.remove();

                    // Check if there are no more rows left in the table
                    const clientListTable = document.querySelector('#clients_table tbody');

                    if (clientListTable && clientListTable.children.length === 0) {
                        console.log('clientListTable is empty:', clientListTable);

                        // Create a new row for "No contacts"
                        const noClientsRow = document.createElement('tr');
                        noClientsRow.id = "no_clients"; // Assign the ID for potential future reference
                        noClientsRow.innerHTML = `
                            <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No clients linked!</td>
                        `;

                        // Append the new row to the table body
                        clientListTable.appendChild(noClientsRow);

                        console.log("Added new 'No contacts' row.");
                    }else{
                    showToast("We did not get the contactListTable ");

                }

                    showToast("client unlinked successfully!");
                } else {
                    console.error("Error unlinking client:", result.message);
                    showToast("Failed to unlink client.");
                }
            } catch (error) {
                console.error("Error during unlink operation:", error);
                showToast("An error occurred while unlinking the contact.");
            }
        }

        // Attach the click event listener to "Unlink" buttons
        document.querySelector('#clients_table tbody').addEventListener('click', (event) => {
            if (event.target.classList.contains('unlink-client-btn')) {
                const button = event.target;
                const clientId = button.getAttribute('data-client-id');
                const rowElement = button.closest('tr');

                if (clientId && rowElement) {
                    unlinkContact(clientId, rowElement);
                }
            }
        });

        // Handle select all functionality
        selectAllCheckbox.addEventListener("change", () => {
            const checkboxes = document.querySelectorAll(".client-checkbox");
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        function showToast(message) {
            const toastMessage = document.getElementById('toastMessage');
            const toastEl = document.getElementById('successToast');
            toastMessage.textContent = message;

            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

    });

</script>

<script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()


</script>
    
 </body>
</html>
