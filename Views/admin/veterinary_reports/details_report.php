<h1>Détails du Rapport Vétérinaire</h1>

<p><strong>Animal :</strong> <?= htmlspecialchars($animal->name) ?></p>
<p><strong>Date du dernier check-up :</strong> <?= date('d-m-Y', strtotime($report->last_checkup_date)) ?></p>

<p><strong>État de santé :</strong> <?= htmlspecialchars($report->health_status) ?></p>
<p><strong>Nourriture donnée :</strong> <?= htmlspecialchars($report->food_given) ?></p>
<p><strong>Quantité de nourriture :</strong> <?= htmlspecialchars($report->food_quantity) ?> g</p>
<p><strong>Notes supplémentaires :</strong> <?= $report->additional_notes ?></p>

<a href="/index.php?controller=animal&action=showAnimalDetails&id=<?= $report->animal_id ?>" class="btn btn-secondary">Retour</a>

