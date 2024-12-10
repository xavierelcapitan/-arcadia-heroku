<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>

   <!-- Header principal -->
   <header class="header-container">
    <!-- Logo -->
    <div class="logo-container my-3">
        <a href="/" class="logo-link">
            <img src="/assets/images/pict/logoarcadia2footer.png" alt="Logo Arcadia" class="logo-img">
        </a>
    </div>

    <!-- Bouton Menu Burger -->
    <button class="menu-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
        ☰ <!-- Symbole classique pour un menu burger -->
    </button>

    <!-- Menu Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="/index.php?controller=page&action=services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="/index.php?controller=page&action=habitats">Habitats</a></li>
                <li class="nav-item"><a class="nav-link" href="/index.php?controller=page&action=contact">Contact</a></li>
            </ul>
        </div>
    </div>
</header>



        <!-- Navigation Principale sous le logo -->
        <nav class="main-nav">
            <a href="/index.php?controller=page&action=services" class="main-nav-button main-nav-button-services">SERVICES</a>
            <a href="/index.php?controller=page&action=habitats" class="main-nav-button main-nav-button-habitats">HABITATS</a>
            <a href="/index.php?controller=page&action=contact" class="main-nav-button main-nav-button-contact">CONTACT</a>
        </nav>


    <main class="main-banner">
        <!-- Inclusion du contenu de la page -->
        <?php if (isset($view)) {
            include $view;
        } ?>
    </main>

    
     <!-- Footer -->
   
    <footer class="footer-container container-fluid px-0">
        <div class="footer-logo">
            <img src="/assets/images/pict/LOGOARCADIAFOOTERXAVIER.png" alt="Logo">
        </div>

        <div class="footer-links">
            <div class="footer-column">
                <h2>Services</h2>
                <ul>
                    <li>Envoyez un avis</li>
                    <li>Accès</li>
                    <li>Restauration</li>
                </ul>
            </div>

            <div class="footer-column">
                <h2>Les habitats</h2>
                <ul>
                    <li>Savanes</li>
                    <li>Jungle</li>
                    <li>Marais</li>
                </ul>
            </div>
        </div>

        <div class="footer-legals">
            <h3>Légales</h3>
            <div class="footer-legal-links">
                <a href="#" class="btn experience-button">RGPD</a>
                <a href="#" class="btn experience-button">CGU</a>
                <a href="#" class="btn experience-button">Mentions légales</a>
            </div>
        </div>

    <div class="footer-connection">
        <a href="/index.php?controller=admin&action=dashboard">Dashboard</a>
    </div>
    <p>&copy; 2024 Arcadia</p>
</footer>
 
     <!-- Scripts JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/js/home_slider.js"></script>
    <script src="/assets/js/animal_count.js"></script>
</body>
</html>
