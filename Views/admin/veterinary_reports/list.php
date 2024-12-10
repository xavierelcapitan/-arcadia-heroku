<h1>Comptes rendus vétérinaires</h1>

<!-- Filtres par animal et par date -->
<div class="filters">
    <label for="animalFilter">Filtrer par animal :</label>
    <select id="animalFilter">
        <option value="">Tous les animaux</option>
        <?php foreach ($animals as $animal): ?>
            <option value="<?= htmlspecialchars($animal->name) ?>"><?= htmlspecialchars($animal->name) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="dateFilter">Filtrer par date :</label>
    <input type="date" id="dateFilter">
</div>

<!-- Table pour les comptes rendus -->
<table id="veterinaryReportsTable" class="display">
    <thead>
        <tr>
            <th>Animal</th>
            <th>Date</th>
            <th>État de santé</th>
            <th>Nourriture donnée</th>
            <th>Quantité</th>
            <th>Recommandations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($veterinary_reports as $report): ?>
            <tr>
                <td><?= htmlspecialchars($report->animal_name) ?></td>
                <td><?= htmlspecialchars($report->checkup_date) ?></td>
                <td><?= htmlspecialchars($report->health_status) ?></td>
                <td><?= htmlspecialchars($report->food_given) ?></td>
                <td><?= htmlspecialchars($report->food_quantity) ?> g</td>
                <td><?= htmlspecialchars($report->recommendations) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
  $(document).ready(function() {
    var table = $('#veterinaryReportsTable').DataTable();

    // Filtrer par animal
    $('#animalFilter').on('change', function() {
        table.column(0).search(this.value).draw();
    });

    // Filtrer par date
    $('#dateFilter').on('change', function() {
        var dateValue = this.value;
        table.column(1).search(dateValue).draw();
    });
  });
</script>
