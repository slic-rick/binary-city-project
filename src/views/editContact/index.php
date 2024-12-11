<?php   include "partials/_header.php"; ?>


<div class="col-8">

    <main class="main container" id="main">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/contacts">Contacts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit contact</li>
        </ol>
        </nav>
    <h1>Edit <?php if(isset($_SESSION['formData'])){ echo $_SESSION['formData']['name'] ?? "".  $_SESSION['formData']['surname']; }else {echo $contact['surname'] ?? "". " ". $contact['name'] ?? "";} ?></h1>
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
    <form id="generalForm" class="needs-validation" action="/updateContact" method="POST" novalidate>
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control <?= !empty($data['errors']['name']) ? 'is-invalid' : '' ?>"  
                id="name" 
                name="name" 
                placeholder="Enter client name" 
                value="<?php if(isset($_SESSION['formData'])){ echo $_SESSION['formData']['name'] ?? ""; }else{echo htmlspecialchars($contact['name'] ?? ''); } ?>" 
                <?php isset($_SESSION['contact']) ? 'readonly' : '' ?>
            >
            <?php if (!empty($data['errors']['name'])): ?>
                <div class="invalid-feedback">
                    <?= htmlspecialchars($data['errors']['name']) ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Surname Field -->
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input 
                type="text" 
                class="form-control <?= !empty($data['errors']['surname']) ? 'is-invalid' : '' ?>"  
                id="surname" 
                name="surname" 
                placeholder="Enter client surname" 
                value="<?php if(isset($_SESSION['formData'])){ echo $_SESSION['formData']['surname'] ?? "";} else { echo htmlspecialchars($contact['surname'] ?? ''); }?>"
                <?php isset($_SESSION['contact']) ? 'readonly' : '' ?>
            >
            <?php if (!empty($data['errors']['surname'])): ?>
                <div class="invalid-feedback">
                    <?= htmlspecialchars($data['errors']['surname']) ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                class="form-control <?= !empty($data['errors']['email']) ? 'is-invalid' : '' ?>"  
                id="email" 
                name="email" 
                placeholder="Enter client email" 
                value="<?php if(isset($_SESSION['formData'])){ echo $_SESSION['formData']['email'] ?? ""; }else{echo htmlspecialchars($contact['email'] ?? '');} ?>"
               
            >
            <?php if (!empty($data['errors']['email'])): ?>
                <div class="invalid-feedback">
                    <?= htmlspecialchars($data['errors']['email']) ?>
                </div>
            <?php endif; ?>
            </div>
                <?php if(empty($_SESSION)) ?>

        <button type="submit" class="btn btn-primary" id="nextTBtn"  style="<?= !empty($_SESSION['contact']) ? 'display: none;' : '' ?>">Next</button>

        <!-- <button type="submit" class="btn btn-primary" id="nextTBtn">Next</button> -->
    </form>
</div>


            <!-- Contacts Tab -->
            <div class="tab-pane fade" id="clients" role="tabpanel" aria-labelledby="clients-tab">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Client Code</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($data['contactClients'])) { ?>
                <tr>
                    <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No clients linked!</td>
                </tr>
            <?php } else {
                $count = 1; // Counter for row numbers
                foreach ($data['contactClients'] as $client) { ?>
                    <tr>
                        <th scope="row"><?php echo $count++; ?></th>
                        <td><?php echo htmlspecialchars($client['client_name'], ENT_QUOTES, 'UTF-8')  ?></td>
                        <td><?php echo htmlspecialchars($client['client_code'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <form method="POST" action="/add-contact?tab=clients">
                                <input type="hidden" name="action" value="unlink_client">
                                <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>"> 
                                <button type="submit" class="btn btn-danger btn-sm unlink-contact-btn">Unlink</button>
                            </form>
                        </td>
                    </tr>
                <?php } 
            } ?>
                  
                        </tbody>
                    </table>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#linkContactsModal">Link Clients</button>
                    <button class="btn btn-primary me-md-2" type="button" onclick="window.location.href='/contacts';">Save</button>
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
                        <form id="linkContactsForm" action="add-contact?tab=clients" method="POST">
                        <input type="hidden" name="contact_id" value="<?php echo isset($_GET['contact']) ? htmlspecialchars($_GET['contact']) : (isset($_SESSION['contact_id']) ? htmlspecialchars($_SESSION['contact_id']) : ''); ?>" />
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

                                
                                    <?php
                                   
                                    foreach ($data['clients'] as $client) {
                                        echo "<tr>
                                                <td><input type='checkbox' name='client_ids[]' class='contact-checkbox' value='" . htmlspecialchars($client['client_id']) . "' /></td>
                                                <td>{$client['name']}</td>
                                                <td>{$client['clientcode']}</td>
                                              </tr>";
                                    }
                                    ?>
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

        <!-- Alert -->

        <?php if (isset($data['success'])): ?>
            <div class="modal" tabindex="-1" id="successModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Success!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> <?php htmlspecialchars($data['success']) ?></p>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary">Okay</button>
                    </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger" role="alert">   
            <?= htmlspecialchars($data['error']) ?>
        </div>
    <?php endif; ?>


    </main>
</div>

</div>
    </div>
         </div>
     </div>

    <?php   include "partials/_scripts.php"; ?>


<script>

document.getElementById("nextTBtn").addEventListener("click", function () {


    const contactsTab = document.getElementById("clients-tab");
    contactsTab.classList.remove("disabled");
    contactsTab.setAttribute("data-bs-toggle", "tab");
    contactsTab.setAttribute("data-bs-target", "#clients");
    const tabTrigger = new bootstrap.Tab(contactsTab);
    tabTrigger.show();

    // Allow the form to submit
    event.target.form.submit();
    form.submit();
});


document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get("tab");

    if (activeTab === "clients") {
        // Activate the Clients tab
        const clientsTab = document.getElementById("clients-tab");
        clientsTab.classList.remove("disabled");
        clientsTab.setAttribute("data-bs-toggle", "tab");
        clientsTab.setAttribute("data-bs-target", "#clients");

        const tabTrigger = new bootstrap.Tab(clientsTab);
        tabTrigger.show();
    } else {
        // Default to the General tab
        const generalTab = document.getElementById("general-tab");
        const tabTrigger = new bootstrap.Tab(generalTab);
        tabTrigger.show();
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
