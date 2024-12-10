<section class="animal-details">
    <!-- Image et nom de l'animal -->
    <div class="animal-image">
        <img src="<?php echo htmlspecialchars($animal->image_url); ?>" alt="Image de <?php echo htmlspecialchars($animal->name); ?>">
        <h1><?php echo htmlspecialchars($animal->name); ?></h1>
    </div>

    <!-- Description de l'animal -->
    <div class="animal-description">
        <p><?php echo ($animal->description); ?></p>
        <button class="find-on-map-btn">Trouver sur le plan</button>
    </div>

    <!-- Informations principales de l'animal -->
    <div class="animal-info">
        <p><strong>Espèce :</strong> <?php echo htmlspecialchars($animal->race); ?></p>
        <p><strong>Habitat :</strong> <?php echo htmlspecialchars($animal->habitat_name); ?></p>
        <p><strong>Âge :</strong> <?php echo htmlspecialchars($animal->age); ?> ans</p>
        <p><strong>Poids :</strong> <?php echo htmlspecialchars($animal->weight); ?> kg</p>
    </div>

    <!-- Fiche Santé -->
    <div class="health-record">
        <h3>Fiche santé</h3>
        <p><strong>Observations vétérinaires :</strong>
          <?php echo ($veterinary_report->additional_notes ?? 'Pas de données disponibles'); ?>
        </p>
        <p><strong>État de santé actuel :</strong>
        <?php echo htmlspecialchars($veterinary_report->health_status ?? 'Pas de données disponibles'); ?>
        </p>
    </div>

    <!-- Informations sur la nourriture -->
    <div class="feeding-info">
        <h3>Nourriture</h3>
        <?php
        // Vérifier si last_checkup_date est défini et non nul, sinon afficher "Pas de données disponibles"
        if (!empty($feeding_report->feeding_date)) {
            $formattedDate = date("d-m-Y", strtotime($feeding_report->feeding_date));
            echo "<p><strong>Dernier passage :</strong> " . htmlspecialchars($formattedDate) . "</p>";
        } else {
            echo "<p><strong>Dernier passage :</strong> Pas de données disponibles</p>";
        }
        
        ?>
        <p><strong>Type de nourriture :</strong> <?php echo htmlspecialchars($feeding_report->food_type_report ?? 'Pas de données disponibles'); ?></p>
        <p><strong>Quantité de nourriture / jour :</strong> <?php echo htmlspecialchars($feeding_report->food_quantity ?? 'Pas de données disponibles'); ?> kg</p>
    </div>
      <!-- Retour -->
      <div class="text-center my-5">
    <button onclick="window.history.back()" class="btn btn-secondary">Retour</button>
</div>

</section>

