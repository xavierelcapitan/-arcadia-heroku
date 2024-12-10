<!-- Views/admin/habitats/create.php -->
<form method="POST" action="/index.php?controller=habitat&action=createHabitat" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control tinymce" id="description" name="description"><?= isset($habitat) ? htmlspecialchars($habitat->description) : '' ?></textarea>
    </div>

    <div class="mb-3">
        <label for="image_url" class="form-label">Image</label>
        <input type="file" class="form-control" id="image_url" name="image_url" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
