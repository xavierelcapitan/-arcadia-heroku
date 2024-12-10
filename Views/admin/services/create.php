<!-- Views/admin/services/create.php -->

<div class="container">
    <form action="/index.php?controller=services&action=createService" method="POST" enctype="multipart/form-data">
        <!-- Nom du service -->                       
        <div class="mb-3">
            <label for="name" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control tinymce" id="description" name="description" rows="3"></textarea>
        </div>

        <!-- Emplacement -->
        <div class="mb-3">
            <label for="location" class="form-label">Emplacement</label>
            <select class="form-select" id="location" name="location" required>
                <option value="entrée">Choisir une option</option>
                <option value="entrée">Entrée</option>
                <option value="jungle">Jungle</option>
                <option value="savane">Savane</option>
                <option value="désert">Désert</option>
                <option value="Aquarium">Aquarium</option>
                <option value="Parc des enfants">Parc des enfants</option>
            </select>
        </div>

        <!-- Horaires -->
        <div class="row mb-3">
            <div class="col">
                <label for="opening_time" class="form-label">Heure d'ouverture</label>
                <input type="time" class="form-control" id="opening_time" name="opening_time">
            </div>
            <div class="col">
                <label for="closing_time" class="form-label">Heure de fermeture</label>
                <input type="time" class="form-control" id="closing_time" name="closing_time">
            </div>
        </div>

        <!-- Tarifs -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="child_price" class="form-label">Tarif enfant</label>
                <input type="number" step="0.01" class="form-control" id="child_price" name="child_price" min="0">
            </div>
            <div class="col-md-4">
                <label for="adult_price" class="form-label">Tarif adulte</label>
                <input type="number" step="0.01" class="form-control" id="adult_price" name="adult_price" min="0">
            </div>
            <div class="col-md-4">
                <label for="group_price" class="form-label">Tarif groupe</label>
                <input type="number" step="0.01" class="form-control" id="group_price" name="group_price" min="0">
            </div>
        </div>

        <!-- Gratuité -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_free" name="is_free">
            <label class="form-check-label" for="is_free">Gratuit</label>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Ajouter le service</button>
    </form>
</div>




