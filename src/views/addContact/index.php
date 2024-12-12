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
    <script src="/assets/js/addContacts.js"></script>

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
