<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

      <!--=================FAVICON========================-->

      <link rel="shortcut icon" type="image/jpg" href="/assets/img/binarycity.jpg"/>

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="assets/css/styles.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <title>Binary City</title>
   </head>
   <body>

      <!--=============== HEADER ===============-->
      <header class="header" id="header">
         <div class="header__container">
            <a href="https://github.com/slic-rick/binary-city-project" target=”_blank” class="header__logo text-decoration-none">
               <!-- <i class="ri-cloud-fill"></i> -->
               <i class="ri-github-fill"></i>
               <span>Github</span>
            </a>
            
            <button class="header__toggle" id="header-toggle">
               <i class="ri-menu-line"></i>
            </button>
         </div>
      </header>

      <div class="container">

        <div class = "row">
            <div class="col-4">
                 <!--=============== SIDEBAR ===============-->
                <nav class="sidebar" id="sidebar">
                    <div class="sidebar__container">
                        <div class="sidebar__user">
                        <div class="sidebar__img">
                            <img src="assets/img/binarycity.jpg" alt="image">
                        </div>
            
                        <div class="sidebar__info">
                            <h3>Binary City</h3>
                            <!-- <span>erickabraham63@gmail.com</span> -->
                        </div>
                        </div>

                        <div class="sidebar__content">
                        <div>
                            <h3 class="sidebar__title">MANAGE</h3>

                            <div class="sidebar__list">
                                <a href="/" class="sidebar__link active-link text-decoration-none">
                                    <!-- <i class="ri-pie-chart-2-fill"></i> -->
                                    <i class="ri-service-line"></i>
                                    <span>Clients</span>
                                </a>
                                
                                <a href="/contacts" class="sidebar__link text-decoration-none">
                                    <!-- <i class="ri-wallet-3-fill"></i> -->
                                    <i class="ri-contacts-book-line"></i>
                                    <span>Contacts</span>
                                </a>
                            </div>
                        </div>

                        </div>

                        <div class="sidebar__actions">
                        <button>
                            <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                                <span>Theme</span>
                            </i>
                        </button>

                        <button class="sidebar__link">
                            <!-- <i class="ri-logout-box-r-fill"></i> -->
                            <i class="ri-file-pdf-fill"></i>
                            <span>Documentation</span>
                        </button>
                        </div>
                    </div>
                </nav>
            </div>