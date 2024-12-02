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
                <button class="nav-link disabled" id="contacts-tab" type="button" role="tab" aria-controls="contacts" aria-selected="false">Clients</button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content p-3 border border-top-0" id="addClientTabsContent">
            <!-- General Tab -->
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form id="generalForm">
                    <div class="mb-3">
                        <label for="clientName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Enter client name" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientEmail" class="form-label">Surname</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Enter client email" required>
                    </div>

                    <div class="mb-3">
                        <label for="clientEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Enter client email" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                </form>
            </div>

            <!-- Contacts Tab -->
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#linkContactsModal">Link Clients</button>
                    <button class="btn btn-primary me-md-2" type="button">Save</button>
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
                        <form id="linkContactsForm">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox" id="selectAll" />
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Example data from the database (Replace with actual query results)
                                    $contacts = [
                                        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                                        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
                                        ['id' => 3, 'name' => 'Bob Brown', 'email' => 'bob@example.com'],
                                    ];
                                    foreach ($contacts as $contact) {
                                        echo "<tr>
                                                <td><input type='checkbox' class='contact-checkbox' value='{$contact['id']}' /></td>
                                                <td>{$contact['id']}</td>
                                                <td>{$contact['name']}</td>
                                                <td>{$contact['email']}</td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveContactsBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

</div>

</div>

<script>
document.getElementById("nextBtn").addEventListener("click", function () {
    const clientName = document.getElementById("clientName").value.trim();
    const clientEmail = document.getElementById("clientEmail").value.trim();

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
});
</script>


         </div>
     </div>

    <?php   include "partials/_scripts.php"; ?>
    
<script>
document.getElementById("nextBtn").addEventListener("click", function () {
    const clientName = document.getElementById("clientName").value.trim();
    const clientEmail = document.getElementById("clientEmail").value.trim();

    if (clientName === "" || clientEmail === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Switch to Contacts tab
    const contactsTab = document.getElementById("contacts-tab");
    contactsTab.classList.remove("disabled");
    contactsTab.setAttribute("data-bs-toggle", "tab");
    contactsTab.click();
});

document.getElementById("contacts-tab").addEventListener("click", function (e) {

    // const generalFormValid = document.getElementById("clientName").value.trim() !== "" && 
    //                          document.getElementById("clientEmail").value.trim() !== "";

    // if (!generalFormValid) {
    //     e.preventDefault(); // Prevent switching tabs
    //     alert("Please complete the General tab first.");
    // }
});
</script>
 </body>
</html>
