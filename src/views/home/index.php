    
      <?php   include "partials/_header.php"; ?>

            <div class ="col-8">
                 <!--=============== MAIN ===============-->
                <main class="main container" id="main">
                <h1>Clients</h1>
                <div class="row mb-3">

                    <!-- Search Bar -->
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" id="search">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">   <span><i class="ri-search-line"></i></i></span> 
                            </button>
                        </div>

                    </div>

                     <!-- Add New Client Button -->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="window.location.href='/add-client';">Add Client</button>
                    </div>
                </div>

                <div class="row mb-3">
                    
                    <div class ="col-md-12">
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Client code</th>
                            <th scope="col">No. of linked contacts</th>
                            </tr>
                        </thead>

                     

                        <tbody id="clients_table">

                        <?php if (empty($clients)) { ?>
                        <tr>
                        <td colspan="4" class="p-4 text-sm text-gray-600 text-center">No clients found!</td>
                        </tr>
                    <?php } else {
                        $count = 1;
                        foreach($clients as $client) { ?>

                            <tr>
                           
                            <td><?php echo htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($client['clientcode'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($client['linked_contacts_count'],ENT_QUOTES, 'UTF-8')?></td>
                            </tr>
                            
                            
                      <?php  }
                        
                    } ?>
                        </tbody>
                    </table>
                    </div>
                </div>

                </main>
            </div>
        </div>
        
      </div>  
    <?php   include "partials/_scripts.php"; ?>

    <script>
    document.getElementById("search").addEventListener("input", function () {
    const query = this.value.trim();
    const resultsContainer = document.getElementById("clients_table");

    if (query.length == 0) {
        // Get the results of all the data
        // resultsContainer.innerHTML = ""; // Clear results if query is too short
        window.location.href = "/";
        
        return;
    }

    // Fetch search results from the server
    fetch(`/search?query=${encodeURIComponent(query)}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.errors) {
                resultsContainer.innerHTML = `<p>${data.errors}</p>`;
                return;
            }

            console.log(data);
            

            // Display results
            if (data.results.length > 0) {
                // show the table with the search results!
                const resultsHtml = data.results
                    .map((item) => `<tr>
                                <td>${item['name']}</td>
                                <td>${item['clientcode']}</td>
                                <td>${item['linked_contacts_count']}</td>
                            </tr>`)
                    .join("");
                resultsContainer.innerHTML =resultsHtml;
            } else {
                resultsContainer.innerHTML = "<p>No clients found!</p>";
            }
        })
        .catch((error) => {
            console.error("Error fetching search results:", error);
            resultsContainer.innerHTML = "<p>Something went wrong. Please try again.</p>";
        });
    });

    </script>

    </body>
</html>
