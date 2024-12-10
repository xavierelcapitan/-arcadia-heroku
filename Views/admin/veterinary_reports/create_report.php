<h1>Ajouter un rapport vétérinaire</h1>

<form action="/index.php?controller=veterinaryReport&action=createReport" method="POST">
    <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal_id ?? '') ?>">

    <div class="mb-3">
    <label for="last_checkup_date">Date de passage</label>
<input type="date" id="last_checkup_date" name="last_checkup_date" class="form-control" required>

    </div>

  <label for="health_status">État de santé</label>
<select id="health_status" name="health_status" class="form-control">
    <option value="En forme">En forme</option>
    <option value="À soigner">À soigner</option>
    <option value="En soins">En soins</option>
    <option value="En guérison">En guérison</option>
    <option value="À surveiller avec attention">À surveiller avec attention</option>
    <option value="Mort">Mort</option>
</select>

    <div class="mb-3">
    <label for="food_given">Nourriture proposée</label>
<select id="food_given" name="food_given" class="form-control" required>
    <option value="">Sélectionnez un type de nourriture</option>
    <?php if (!empty($foodTypes)): ?>
        <?php foreach ($foodTypes as $foodType): ?>
            <option value="<?= htmlspecialchars($foodType->food_type) ?>">
                <?= htmlspecialchars($foodType->food_type) ?>
            </option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">Aucun type de nourriture disponible</option>
    <?php endif; ?>
</select>


    </div>

    <div class="mb-3">
        <label for="food_quantity" class="form-label">Quantité de nourriture (en grammes)</label>
        <input type="number" class="form-control" id="food_quantity" name="food_quantity" min="0" required>
    </div>

    <div class="mb-3">
        <label for="additional_notes" class="form-label">Recommandations supplémentaires</label>
        <textarea class="form-control tinymce" id="additional_notes" name="additional_notes"></textarea>

    
    </div>

    <button type="submit" class="btn btn-primary">Ajouter le rapport</button>
</form>

<script src="/assets/js/animal_report.js"></script>

