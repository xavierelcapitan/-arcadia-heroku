<!-- Views/admin/services/edit.php -->
<div class="container">
    <form action="/index.php?controller=services&action=editService&id=<?php echo $service->id; ?>" method="POST" enctype="multipart/form-data">
        <!-- Nom du service -->
        <div class="mb-3">
            <label for="name" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($service->name); ?>" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control tinymce" id="description" name="description" rows="3"><?php echo htmlspecialchars($service->description); ?></textarea>
        </div>

        <!-- Emplacement -->
        <div class="mb-3">
            <label for="location" class="form-label">Emplacement</label>
            <select class="form-select" id="location" name="location" required>
                <?php 
                    $locations = ['entrée', 'jungle', 'savane', 'désert', 'Aquarium', 'Parc des enfants'];
                    foreach ($locations as $location) {
                        $selected = $service->location === $location ? 'selected' : '';
                        echo "<option value=\"$location\" $selected>$location</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Horaires -->
        <div class="row mb-3">
            <div class="col">
                <label for="opening_time" class="form-label">Heure d'ouverture</label>
                <input type="time" class="form-control" id="opening_time" name="opening_time" value="<?php echo htmlspecialchars($service->opening_time); ?>">
            </div>
            <div class="col">
                <label for="closing_time" class="form-label">Heure de fermeture</label>
                <input type="time" class="form-control" id="closing_time" name="closing_time" value="<?php echo htmlspecialchars($service->closing_time); ?>">
            </div>
        </div>

        <!-- Tarifs -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="child_price" class="form-label">Tarif enfant</label>
                <input type="number" step="0.01" class="form-control" id="child_price" name="child_price" value="<?php echo htmlspecialchars($service->child_price); ?>">
            </div>
            <div class="col-md-4">
                <label for="adult_price" class="form-label">Tarif adulte</label>
                <input type="number" step="0.01" class="form-control" id="adult_price" name="adult_price" value="<?php echo htmlspecialchars($service->adult_price); ?>">
            </div>
            <div class="col-md-4">
                <label for="group_price" class="form-label">Tarif groupe</label>
                <input type="number" step="0.01" class="form-control" id="group_price" name="group_price" value="<?php echo htmlspecialchars($service->group_price); ?>">
            </div>
        </div>

        <!-- Gratuité -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_free" name="is_free" <?php echo $service->is_free ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_free">Gratuit</label>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
            <?php if (!empty($service->image_path)): ?>
                <img src="<?php echo $service->image_path; ?>" alt="Image actuelle" style="width: 100px; margin-top: 10px;">
            <?php endif; ?>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Mettre à jour le service</button>
    </form>
</div>



