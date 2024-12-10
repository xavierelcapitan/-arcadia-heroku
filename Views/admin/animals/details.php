<?php 
// Views/admin/animals/details.php



// Dans details.php ou toute autre page protégée
use App\Config\SessionManager;

SessionManager::start(); // Démarre la session si ce n'est pas déjà fait

if (!SessionManager::has('user_id')) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de login
    header('Location: /index.php?controller=auth&action=showLogin');
    exit;
}

// Utiliser les variables de session
$user_role = SessionManager::get('user_role');
?>


<div>
    <!-- Image de l'animal -->
    <img src="<?= htmlspecialchars($animal->image_url) ?>" alt="Image de l'animal" width="200">

    <!-- Nom de l'animal -->
    <h2>Nom : <?= htmlspecialchars($animal->name) ?></h2>

    <!-- Race de l'animal -->
    <p><strong>Race : </strong><?= htmlspecialchars($animal->race) ?></p>

    <!-- Âge de l'animal -->
    <p><strong>Âge : </strong><?= htmlspecialchars($animal->age) ?> ans</p>

    <!-- Poids de l'animal -->
    <p><strong>Poids : </strong><?= htmlspecialchars($animal->weight) ?> kg</p>

    <!-- Habitat de l'animal -->
    <p><strong>Habitat : </strong><?= htmlspecialchars($animal->habitat_name) ?></p>

    <!-- Type de nourriture de l'animal -->
    <p><strong>Type de nourriture : </strong><?= htmlspecialchars($animal->food_type) ?></p>

    <p><strong>Description : </strong><?php echo htmlspecialchars_decode($animal->description); ?></p>
</div>


<!-- Admin : Boutons Modifier et Supprimer -->
<?php if ($user_role == 'admin'): ?>
    <a href="/index.php?controller=animal&action=editAnimal&id=<?= $animal->id ?>" class="btn btn-warning">Modifier</a>
    <form method="POST" action="/index.php?controller=animal&action=deleteAnimal&id=<?= $animal->id ?>" style="display:inline;">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">Supprimer</button>
    </form>
<?php endif; ?>


<!-- Nourrir l'animal (visible uniquement pour admin et employe) -->
<?php if ($user_role == 'admin' || $user_role == 'employe'): ?>
    <h4>Nourrir l'animal</h4>
    <form action="/index.php?controller=feedingReport&action=addReport&animal_id=<?= $animal->id ?>" method="POST">
        <div class="mb-3">
            <label for="food_type_report" class="form-label">Type de nourriture</label>
            <select class="form-control" id="food_type_report" name="food_type_report" required>
                <option value="">Sélectionnez le type de nourriture</option>
                <?php foreach ($foodTypes as $foodType): ?>
                    <option value="<?= htmlspecialchars($foodType->food_type) ?>"><?= htmlspecialchars($foodType->food_type) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="food_quantity" class="form-label">Quantité de nourriture (g)</label>
            <input type="number" class="form-control" id="food_quantity" name="food_quantity" min="0" required>
        </div>

        <div class="mb-3">
            <label for="feeding_date" class="form-label">Date et heure de nourrissage</label>
            <input type="datetime-local" class="form-control" id="feeding_date" name="feeding_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter un rapport de nourriture</button>
    </form>

    <!-- Afficher l'historique des nourrissages -->
    <h4>Historique des repas</h4>
    <?php if (!empty($feeding_reports)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th> 
                    <th>Type de nourriture</th>
                    <th>Quantité (g)</th>
                    <th>Ajouté par</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feeding_reports as $report): ?>
                    <tr>
                    <td><?= date('d-m-Y H:i', strtotime($report->feeding_date)) ?></td>
                        <td><?= htmlspecialchars($report->food_type_report) ?></td>
                        <td><?= htmlspecialchars($report->food_quantity) ?> g</td>
                        <td><?= htmlspecialchars($report->user_name) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun rapport de nourriture disponible.</p>
    <?php endif; ?>
<?php endif; ?>



<!-- Rapports vétérinaires : disponibles pour tous les rôles -->
<h4>Rapports vétérinaires</h4>
<?php if (!empty($veterinary_reports)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>État de santé</th>
                <th>Type de nourriture</th>
                <th>Quantité</th>
                <th>Recommandations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veterinary_reports as $report): ?>
                <tr>
              
                    <td><?= date('d-m-y', strtotime($report->last_checkup_date)) ?></td>

                    <td><?= htmlspecialchars($report->health_status) ?></td> 
                    <td><?= htmlspecialchars($report->food_given) ?></td>
                    <td><?= htmlspecialchars($report->food_quantity) ?> g</td>
                    <td>
                        <!-- Actions sur les rapports pour vétérinaire et admin -->
                        <?php if ($user_role == 'veterinaire' || $user_role == 'admin'): ?>
                            <a href="/index.php?controller=VeterinaryReport&action=showReportDetails&id=<?= $report->id ?>" class="btn btn-info">Détails</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun rapport vétérinaire disponible.</p>
<?php endif; ?>

<!-- Ajout de rapport vétérinaire : uniquement pour vétérinaire et admin -->
<?php if ($user_role == 'veterinaire' || $user_role == 'admin'): ?>
    <a href="/index.php?controller=veterinaryReport&action=createReport&animal_id=<?= $animal->id ?>" class="btn btn-primary">Ajouter un rapport vétérinaire</a>
<?php endif; ?>
