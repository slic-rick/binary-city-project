<?php   include "partials/_header.php"; ?>




<div class="col-8">

    <main class="main container" id="main">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add client</li>
        </ol>
        </nav>
    <h1>Create new client</h1>
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="addClientTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled" id="contacts-tab" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content p-3 border border-top-0" id="addClientTabsContent">
            <!-- General Tab -->
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <form id="generalForm" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="name" class="form-label">Client Name</label>
                    <input type="text" 
                        class="form-control" 
                        id="name" name="name" 
                        placeholder="Enter client name">
                    <div class="invalid-feedback" id="nameError"></div>
                </div>

                 <div class="mb-3" style="display: none;">
                    <label for="clientCode" class="form-label">Client Code</label>
                    <input type="text" 
                        class="form-control" 
                        id="clientCode" name="clientCode" 
                        readonly>
                    <div class="invalid-feedback" id="clientCodeError"></div>
                </div>
                <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
            </form>

            </div>

            <!-- Contacts Tab -->
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div>
            <table class="table" id="contactsTable">
                <thead>
                  
                 <tr>
                    <th scope="col" style="display:none;"></th>
                    <th scope="col">Contact Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"> </th>
                </tr>

                   
                </thead>
            <tbody>
           
                <tr id="no_contacts">
                    <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No contacts linked!</td>
                </tr>   
            </tbody>
        </table>
        </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" id = "linkContactsButton" data-bs-toggle="modal" data-bs-target="#linkContactsModal">Link Contact</button>
                    <button class="btn btn-primary me-md-2" type="button" onclick="window.location.href='/';">Done</button>
                    <!-- <button class="btn btn-primary" type="button">Button</button> -->
                </div>
            </div>
        </div>

        <!-- Link Contacts Modal -->
        <div class="modal fade" id="linkContactsModal" tabindex="-1" aria-labelledby="linkContactsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="linkContactsModalLabel">Link Contacts</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="linkContactsForm" action ="/add-client" method="POST">
                        <input type="hidden" name="client_id" value="" />
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox" id="selectAll" />
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  

                               
                                        
                                       
                                   <!-- <tr>
                                      <td><input type='checkbox' name='contact_ids[]' class='contact-checkbox' /></td>
                                     <td> </td>
                                     <td></td>
                                    </tr> -->
                                       
                                </tbody>
                            </table>
                            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveContactsBtn">Save</button>
                        </div>
                        </form>
                    </div>
           
                </div>
            </div>
        </div>

        <!-- TOAST -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMessage">Client saved successfully!</div>
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

    <script src="/assets/js/addClients.js"></script>

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
