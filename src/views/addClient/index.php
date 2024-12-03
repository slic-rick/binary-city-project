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
                <form id="generalForm" action="/add-client" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter client name" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="clientEmail" class="form-label">Client Email</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Enter client email" required>
                    </div> -->
                    <button type="submit" class="btn btn-primary" id="nextBtn">Next</button>
                </form>
            </div>

            <!-- Contacts Tab -->
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Contact Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($data['clientContacts'])) { ?>
                <tr>
                    <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No contacts linked!</td>
                </tr>
            <?php } else {
                $count = 1; // Counter for row numbers
                foreach ($data['clientContacts'] as $contact) { ?>
                    <tr id="contact-row-<?php echo $contact['contact_id']; ?>">
                        <th scope="row"><?php echo $count++; ?></th>
                        <td><?php echo htmlspecialchars($contact['contact_name'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($contact['contact_surname'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($contact['contact_email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <form method="POST" action="/add-client?tab=contacts">
                                <input type="hidden" name="action" value="unlink_contact">
                                <input type="hidden" name="contact_id" value="<?php echo $contact['contact_id']; ?>">
                                <input type="hidden" name="client_id" value="<?php echo $contact['client_id']; ?>">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#linkContactsModal">Link Contact</button>
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
                        <form id="linkContactsForm" action ="/add-client?tab=contacts" method="POST">
                        <input type="hidden" name="client_id" value="<?php echo isset($_GET['client']) ? htmlspecialchars($_GET['client']) : (isset($_SESSION['client_id']) ? htmlspecialchars($_SESSION['client_id']) : ''); ?>" />
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

                                <?php if(empty($data['contacts'])) { ?>
                                    <tr>
                                        <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No contacts found!</td>
                                    </tr>

                               <?php } else { 
                                        
                                        // Example data from the database (Replace with actual query results)
                                        foreach ($data['contacts'] as $contact) { ?>
                                          <?php  echo "<tr>
                                                    <td><input type='checkbox' name='contact_ids[]' class='contact-checkbox' value='" . htmlspecialchars($contact['id']) . "' /></td>
                                                    <td>" . htmlspecialchars($contact['name']) . " " . htmlspecialchars($contact['surname']) . "</td>
                                                    <td>" . htmlspecialchars($contact['email']) . "</td>
                                                </tr>";
                                       }
                                } ?>

                       
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

    </main>
</div>

</div>

</div>



         </div>
     </div>

    <?php   include "partials/_scripts.php"; ?>
    
<script>
document.getElementById("nextBtn").addEventListener("click", function () {
    const clientName = document.getElementById("name").value.trim();
    const clientEmail = document.getElementById("email").value.trim();

    if (clientName === "" || clientEmail === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Enable the Contacts tab and switch to it
    const contactsTab = document.getElementById("contacts-tab");
    contactsTab.classList.remove("disabled");
    contactsTab.setAttribute("data-bs-toggle", "tab");
    contactsTab.setAttribute("data-bs-target", "#contacts");
    const tabTrigger = new bootstrap.Tab(contactsTab);
    tabTrigger.show();

    // Allow the form to submit
    event.target.form.submit();
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get("tab");

    if (activeTab === "contacts") {
        // Activate the Contacts tab
        const contactsTab = document.getElementById("contacts-tab");
        contactsTab.classList.remove("disabled");
        contactsTab.setAttribute("data-bs-toggle", "tab");
        contactsTab.setAttribute("data-bs-target", "#contacts");
        const tabTrigger = new bootstrap.Tab(contactsTab);
        tabTrigger.show();
    }
});
</script>
    

 </body>
</html>
