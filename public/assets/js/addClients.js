

    document.addEventListener("DOMContentLoaded", () => {

        // JavaScript code
        const linkContactsButton = document.getElementById("linkContactsButton");
        const saveContactsButton = document.getElementById("saveContactsBtn");
        const selectAllCheckbox = document.getElementById("selectAll");

        document.getElementById("nextBtn").addEventListener("click", async () => {
            const formData = new FormData(document.getElementById("generalForm"));

            try {
                console.log('Form data is', formData);

                const response = await fetch('/add-client', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json', // Optional: Expecting a JSON response
                    },
                });

                const result = await response.json();
                console.log('The result is', result);

                // Clear previous error states
                const nameInput = document.getElementById("name");
                const nameError = document.getElementById("nameError");
                nameError.textContent = ""; // Clear any previous error message
                nameInput.classList.remove("is-invalid"); // Remove error styling

                if (result.success) {
                    showToast("Client added successfully!");

                    // Enable the contacts tab and trigger the tab switch
                    const contactsTab = document.getElementById("contacts-tab");

                    // Remove the disabled class
                    contactsTab.classList.remove("disabled");

                    // Set the necessary Bootstrap data attributes
                    contactsTab.setAttribute("data-bs-toggle", "tab");
                    contactsTab.setAttribute("data-bs-target", "#contacts");

                    // Create a new Bootstrap Tab instance and show the contacts tab
                    const tabTrigger = new bootstrap.Tab(contactsTab);
                    tabTrigger.show();

                    addClientCodeField(result.client.clientCode);

                    // Change the "Next" button text to "Update"
                    const nextBtn = document.getElementById("nextBtn");
                    nextBtn.textContent = "Update";
                    nextBtn.classList.remove("btn-primary");
                    nextBtn.classList.add("btn-success"); 

                } else if (result.errors) {
                    // Set the error message
                    if (result.errors.name) {
                        nameError.textContent = result.errors.name;
                        nameInput.classList.add("is-invalid");
                    }
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });

        /**
         *  LOGIC FOR LINKING AND UNLINKING A CONTACT
         */



        // Handle the click event for "Link Contact"
        document.getElementById('linkContactsButton').addEventListener("click", async () => {
        try {
            // Fetch all contacts
            const contactsResponse = await fetch('/get-contacts');
            // const raw = await  contactsResponse.text();
            // console.log('raw contacts response',raw);
            
            const contactsData = await contactsResponse.json();

            // Fetch linked contacts for the current client
            const linkedResponse = await fetch('/get-linked-contacts');
            // const rawLinked = await  linkedResponse.text();

            // console.log('raw Linked response',rawLinked);


            const linkedData = await linkedResponse.json();

            if (contactsData.success && linkedData.success) {
                const tableBody = document.querySelector("#linkContactsModal .table tbody");
                tableBody.innerHTML = ''; // Clear the table

                const linkedContacts = linkedData.linkedContacts || []; // Fallback to empty array

                // Populate the modal table with all contacts
                contactsData.contacts.forEach(contact => {
                    const isChecked = linkedContacts.some(
                        linkedContact => linkedContact.contact_id === contact.id
                    );

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><input type="checkbox" name="contact_ids[]" class="contact-checkbox" value="${contact.id}" ${isChecked ? 'checked' : ''} /></td>
                        <td>${contact.name} ${contact.surname}</td>
                        <td>${contact.email}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
        } catch (error) {
            console.error("Error fetching contacts:", error);
        }
        });


        // Handle the "Save" button on the modal
        document.getElementById("saveContactsBtn").addEventListener("click", async (e) => {
            e.preventDefault();

            const form = document.getElementById("linkContactsForm");
            const formData = new FormData(form);

            try {

                const response = await fetch(form.action, {
                    method: form.method,
                    body: formData
                });

                // Log raw response before parsing
                //  const rawText = await response.text();
                // console.log('Raw response text:', rawText);

                const result = await response.json();

                if (result.success) {   

                    // Close the modal
                    const modalElement = document.getElementById("linkContactsModal");
                    const modalInstance = bootstrap.Modal.getInstance(modalElement); // Get the active instance
                    if (modalInstance) {
                        modalInstance.hide(); // Hide the modal
                    }


                    // Show the linked contacts in the table
                    const contactListTable = document.querySelector('#contactsTable tbody');
                    contactListTable.innerHTML = ''; // Clear existing rows

                    // hide the no contacts tr if we linked contacts.
                    if(result.linkedContacts.length > 0){
                        const noContact = document.getElementById("no_contacts");
                        // add the style display:none to the tr
                        if (noContact) {
                            noContact.style.display = "none"; // Hide the "no contacts" row
                        }
                    }

                    result.linkedContacts.forEach(contact => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                        <td style="display:none">${contact.contact_id}</td> 
                        <td>${contact.contact_name} ${contact.contact_surname}</td>
                        <td>${contact.contact_email}</td>
                        <td><button class="btn btn-danger btn-sm unlink-contact-btn" data-contact-id="${contact.contact_id}">Unlink</button></td> `;


                        contactListTable.appendChild(row);

                        
                    });

                    showToast("Contacts linked successfully!");

                    // Automatically tick selected contacts on re-open
                    result.linkedContacts.forEach(contact => {
                        const checkbox = document.querySelector(`input[value="${contact.contact_id}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                } else {
                    console.error("Error linking contacts:", result.message);
                }
            } catch (error) {
                console.error("Error saving contacts:", error);
            }
        });

        // unlink the selectedContact

        // Function to handle unlinking a contact
        async function unlinkContact(contactId, rowElement) {
            try {
                const response = await fetch('unlink-contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ contact_id: contactId }).toString(),});

                // const rawres = await response.text();
                // console.log("The response is",rawres);
                


                const result = await response.json();

                if (result.success) {
                    // Remove the row from the table
                    rowElement.remove();

                    // Check if there are no more rows left in the table
                    const contactListTable = document.querySelector('#contacts tbody');

                    if (contactListTable && contactListTable.children.length === 0) {
                        console.log('contactListTable is empty:', contactListTable);

                        // Create a new row for "No contacts"
                        const noContactsRow = document.createElement('tr');
                        noContactsRow.id = "no_contacts"; // Assign the ID for potential future reference
                        noContactsRow.innerHTML = `
                            <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No contacts linked!</td>
                        `;

                        // Append the new row to the table body
                        contactListTable.appendChild(noContactsRow);

                        console.log("Added new 'No contacts' row.");
                    }else{
                    showToast("We did not get the contactListTable ");

                }

                    showToast("Contact unlinked successfully!");
                } else {
                    console.error("Error unlinking contact:", result.message);
                    showToast("Failed to unlink contact.");
                }
            } catch (error) {
                console.error("Error during unlink operation:", error);
                showToast("An error occurred while unlinking the contact.");
            }
        }

        // Attach the click event listener to "Unlink" buttons
        document.querySelector('#contacts tbody').addEventListener('click', (event) => {
            if (event.target.classList.contains('unlink-contact-btn')) {
                const button = event.target;
                const contactId = button.getAttribute('data-contact-id');
                const rowElement = button.closest('tr');

                if (contactId && rowElement) {
                    unlinkContact(contactId, rowElement);
                }
            }
        });



        // Handle select all functionality
        selectAllCheckbox.addEventListener("change", () => {
            const checkboxes = document.querySelectorAll(".contact-checkbox");
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        //
        function showToast(message) {
            const toastMessage = document.getElementById('toastMessage');
            const toastEl = document.getElementById('successToast');
            toastMessage.textContent = message;

            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        // Function to add the readonly clientCode field to the form
        // Function to add the readonly clientCode field to the form
        function addClientCodeField(clientCode) {
            
            const clientCodeInput = document.getElementById("clientCode");

            clientCodeInput.closest('.mb-3').style.display = '';
            
            // Update the clientCode field with the new client code
            clientCodeInput.value = clientCode;  // Set the clientCode value dynamically
        }


    });

