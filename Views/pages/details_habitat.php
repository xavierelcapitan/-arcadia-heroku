<?php
// Views/pages/details_habitat.php

use App\Controllers\HabitatController;

$habitatController = new HabitatController();

$habitats = $habitatController->publicHabitats();

// Récupère l'id de l'habitat à partir de l'URL
$habitatId = isset($_GET['habitat_id']) ? (int) $_GET['habitat_id'] : 0;
$animals = $habitatController->getAnimalsByHabitat($habitatId);

// Si aucun animal n'est trouvé pour cet habitat
if (!$habitatId || empty($animals)) {
    echo "Aucun animal trouvé pour cet habitat.";
    exit;
}
?>


<!-- DETAIL CARD ANIMAL -->
<div class="habitat-details">
    <div class="habitat-banner mb-5">
        <p class="page-title"><?php echo htmlspecialchars($habitat->name); ?></p>
    </div>
    <div class="animal-cards-container-detail">
        <?php foreach ($animals as $animal) : ?>
            <div class="animal-card-detail">
                <div class="animal-card-img-container-detail">
                    <a href="index.php?controller=publicAnimal&action=showAnimalDetails&id=<?php echo $animal->id; ?>" 
                       class="animal-link" 
                       data-id="<?php echo $animal->id; ?>">
                        <img src="<?php echo htmlspecialchars($animal->image_url); ?>" alt="Image de <?php echo htmlspecialchars($animal->name); ?>" class="animal-card-img-detail">
                        <div class="animal-card-overlay-detail">
                            <div class="animal-card-content-detail">
                                <h3 class="animal-title-nature-detail"><?php echo htmlspecialchars($animal->name); ?></h3>
                                <p class="animal-description-detail"><?php echo htmlspecialchars($animal->race); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


        <div class="text-center my-5">
          <a href="/index.php?controller=page&action=habitats" class="btn btn-secondary">Retour aux habitats</a>
        </div>


        <script src="/assets/js/animal_count.js"></script>