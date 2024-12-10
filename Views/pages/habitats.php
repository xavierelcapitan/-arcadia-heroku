<?php
use App\Controllers\HabitatController;

$habitatController = new HabitatController();
$habitats = $habitatController->publicHabitats();
?>

    
    <!-- Image de bannière en plein écran avec horaires en superposition -->
    <section class="banner-section">
        <img src="/assets/images/animals/Arcadia-animals-image07.webp" alt="Elephant" class="banner-img">
        <div class="banner-text">
            <p class="page-title">LES HABITATS</p>
        </div>
    </section>

    <!-- Section Expérience inoubliable -->
    <section class="experience-section text-center mt-5">
        <h3 class="experience-title mb-2 px-4">Vivez une expérience inoubliable au Zoo d'Arcadia</h3>
        <p class="experience-subtitle m-4">Visitez nos 3 habitats</p>
    </section>
    

<!-- Boucle pour afficher chaque habitat -->
<?php foreach ($habitats as $habitat) : ?>
    <section class="experience-card">
        <div class="experience-card-img-container">
        <img src="<?php echo htmlspecialchars($habitat->image_url); ?>" alt="Habitats <?php echo htmlspecialchars($habitat->name); ?>" class="experience-card-img" />

            <div class="experience-card-overlay">
                <div class="experience-card-content">
                    <h3 class="experience-title-nature"><?php echo htmlspecialchars($habitat->name); ?></h3>
                    <p class="experience-description"><?php echo htmlspecialchars_decode($habitat->description); ?></p>
                
                    <a href="index.php?controller=habitat&action=showHabitatDetails&habitat_id=<?php echo $habitat->id; ?>" class="btn experience-button">
                    Plus de <?php echo htmlspecialchars($habitat->species_count); ?> espèces
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endforeach; ?>


