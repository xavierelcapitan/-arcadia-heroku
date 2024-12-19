
<!-- Image de bannière en plein écran avec horaires en superposition -->
<section class="banner-section">
    <img src="/assets/images/animals/Arcadia-animals-image17.webp" alt="Elephant" class="banner-img">
    <div class="banner-text">
        <?php if (isset($todaySchedule)): ?>
            <?php if ($todaySchedule['is_closed']): ?>
                <p class="banner-hours-title pt-3">HORAIRES DU ZOO AUJOURD'HUI : <span class="opening-hours">Fermé</span></p>
            <?php else: ?>
                <p class="banner-hours-title pt-3">HORAIRES DU ZOO AUJOURD'HUI : 
                    <span class="opening-hours"><?= htmlspecialchars($todaySchedule['opening_time']) ?> – <?= htmlspecialchars($todaySchedule['closing_time']) ?></span>
                </p>
            <?php endif; ?>
        <?php else: ?>
            <p class="banner-hours-title pt-3">HORAIRES DU ZOO AUJOURD'HUI : <span class="opening-hours">Non disponibles</span></p>
        <?php endif; ?>
    </div>
</section>



    <!-- Section Préparer votre visite -->
    <section class="visit-section">
        <p class="visit-subtitle">une journée unique qui s’annonce</p>
        <h2 class="visit-title mb-4">Préparer ma visite</h2>
        <a href="/services" class="button-services mb-4">SERVICES</a>
    </section>
   
        <nav class="main-nav">
            <a href="/services" class="main-nav-button main-nav-button-services">PETIT TRAIN</a>
            <a href="/habitats" class="main-nav-button main-nav-button-famille">EN FAMILLE</a>
            <a href="/contact" class="main-nav-button main-nav-button-contact">DEVENEZ BÉNÉVOLE</a>
        </nav>
   


    <!-- Section Expérience inoubliable -->
    <section class="experience-section text-center mt-5">
        <h3 class="experience-title mb-2 px-4">Vivez une expérience inoubliable au Zoo d'Arcadia</h3>
        <p class="experience-subtitle m-4">Quelle expérience préférez-vous ?</p>
        <?php
var_dump($todaySchedule);
?>
    </section>
    

  

    <!-- Section card expériences -->
<section class="experience-card">
    <div class="experience-card-img-container">
        <img src="/assets/images/animals/Arcadia-animals-image01.webp" alt="Expérience nature" class="experience-card-img" />
        <div class="experience-card-overlay">
            <div class="experience-card-content">
                <h3 class="experience-title-nature">Vivez la nature</h3>
                <p class="experience-description">Des aventures uniques et des histoires fascinantes que vous ne trouverez nulle part ailleurs.</p>
                <p class="experience-price">À partir de 92 € par personne</p>
                <a href="/experiences" class="btn experience-button">Voir toutes les expériences</a>
            </div>
        </div>
    </div>
</section>

<section class="experience-card">
    <div class="experience-card-img-container">
        <img src="/assets/images/animals/Arcadia-animals-image25.webp" alt="Expérience nature" class="experience-card-img" />
        <div class="experience-card-overlay">
            <div class="experience-card-content">
                <h3 class="experience-title-soigneur">Soigneur d'un jour</h3>
                <p class="experience-description">Améliorez votre visite avec une expérience véritablement spéciale</p>
                <p class="experience-price">À partir de 249 € par personne</p>
                <a href="/experiences" class="btn experience-button">Voir toutes les expériences</a>
            </div>
        </div>
    </div>
</section>

<section class="experience-card">
    <div class="experience-card-img-container">
        <img src="/assets/images/animals/Arcadia-animals-image14.webp" alt="Expérience nature" class="experience-card-img" />
        <div class="experience-card-overlay">
            <div class="experience-card-content">
                <h3 class="experience-title-vip">Expériences VIP</h3>
                <p class="experience-description">Offez-vous un accès inégalé pour une expérience inoubliable.</p>
                <p class="experience-price">À partir de 395 € par personne</p>
                <a href="/experiences" class="btn experience-button">Voir toutes les expériences</a>
            </div>
        </div>
    </div>
</section>


<section class="map-card mt-5">
    <div class="map-card-map">
        <!-- Intégration Google Maps -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d674893.0335951245!2d-2.1917!3d48.0165!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x481d1e160df9fc97%3A0x1e6742089bcb6b0!2sFor%C3%AAt%20de%20Broc%C3%A9liande%2C%2056400%20Paimpont%2C%20France!5e0!3m2!1sfr!2sfr!4v1615120412106!5m2!1sfr!2sfr"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="map-card-content mt-5">
        <i class="fas fa-map-marker-alt map-icon"></i>
        <h3 class="map-title">ZOO ARCADIA</h3>
        <p class="map-subtitle">Préparez votre itinéraire</p>
        <p class="map-address">666 rue du Paradis, Brocéliande, 012345</p>
        <p class="map-address">Le zoo Arcadia est situé à 450km de Paris, 250km de Rennes.</p>
        <a href="#ensavoirplus" class="ensavoirplus">voir le plan</a>
    </div>
</section>



    <!-- Bloc d'Avis -->
    <section class="reviews-container">
    <h2 class="reviews-title">AVIS DES VISITEURS</h2>
    <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
                // Récupération des avis
                $reviewController = new \App\Controllers\ReviewController();
                $approvedReviews = $reviewController->getApprovedReviews();
                
                foreach ($approvedReviews as $review): ?>
                    <div class="swiper-slide review-slide">
                        <h3><?= htmlspecialchars($review->visitor_pseudo) ?></h3>
                        <p><?= htmlspecialchars($review->comment) ?></p>
                    </div>
                <?php endforeach; ?>
        </div>
        <!-- Pagination et navigation Swiper -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

    

<!-- Bouton pour ouvrir la modale -->
<button id="openModal" class="btn-publish-review">Publier un avis</button>

<!-- Modale pour le formulaire d'avis -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Laissez un avis</h2>
        <form action="/index.php?controller=review&action=submitReview" method="POST">
            <label for="visitor_pseudo">Pseudo :</label>
            <input type="text" id="visitor_pseudo" name="visitor_pseudo" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="comment">Votre avis :</label>
            <textarea id="comment" name="comment" required></textarea>

            <button type="submit" class="submit-button">Envoyer</button>
        </form>
    </div>
</div>