        <?php   include "partials/_header.php"; ?>

            <div class ="col-8">
                 <!--=============== MAIN ===============-->
                <main class="main container" id="main">
                <h1>Contacts</h1>
                <div class="row mb-3">

                    <!-- Search Bar -->
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Contact" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">   <span><i class="ri-search-line"></i></i></span> 
                            </button>
                        </div>

                    </div>

                     <!-- Add New Client Button -->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="window.location.href='/add-contact';">Add Contact</button>
                    </div>
                </div>

                <div class="row mb-3">
                    
                    <div class ="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">surname</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">No. of linked clients</th>
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
                </div>

                </main>
            </div>
        </div>
        
      </div>  
      <!--=============== MAIN JS ===============-->
      <!-- <script src="assets/js/main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   -->
     <?php   include "partials/_scripts.php"; ?>
    </body>
</html>