<form method="POST" action="/index.php?controller=animal&action=editAnimal&id=<?= $animal->id ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Prénom de l'animal</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($animal->name) ?>" required>
    </div>
    <div class="mb-3">
        <label for="race" class="form-label">Race</label>
        <input type="text" class="form-control" id="race" name="race" value="<?= htmlspecialchars($animal->race) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="description">Description de l'animal</label>
        <textarea name="description" id="description" rows="5" class="form-control tinymce"><?php echo isset($animal) ? htmlspecialchars($animal->description) : ''; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Âge</label>
        <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($animal->age) ?>" required>
    </div>
    <div class="mb-3">
        <label for="weight" class="form-label">Poids (en kg)</label>
        <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="<?= htmlspecialchars($animal->weight) ?>" required>
    </div>
    <div class="mb-3">
        <label for="image_url" class="form-label">Image de l'animal</label>
        <input type="file" class="form-control" id="image_url" name="image_url">
        <img src="<?= htmlspecialchars($animal->image_url) ?>" alt="Image de l'animal" width="100">
    </div>
    <div class="mb-3">
        <label for="habitat_id" class="form-label">Habitat</label>
        <select class="form-control" id="habitat_id" name="habitat_id" required>
            <!-- Boucle pour afficher les habitats disponibles -->
            <?php foreach ($habitats as $habitat): ?>
                <option value="<?= $habitat->id ?>" <?= ($animal->habitat_id == $habitat->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($habitat->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="food_type" class="form-label">Type de nourriture</label>
        <input type="text" class="form-control" id="food_type" name="food_type" value="<?= htmlspecialchars($animal->food_type) ?>" required>
    </div>
    <div class="mb-3">
        <label for="food_quantity" class="form-label">Quantité de nourriture (en grammes)</label>
        <input type="number" class="form-control" id="food_quantity" name="food_quantity" value="<?= htmlspecialchars($animal->food_quantity) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

