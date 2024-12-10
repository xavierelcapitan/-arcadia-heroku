<!-- Views/admin/habitats/edit.php -->
<form method="POST" action="/index.php?controller=habitat&action=editHabitat&id=<?= $habitat->id ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($habitat->name) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control tinymce" id="description" name="description"><?= isset($habitat) ? $habitat->description : '' ?></textarea>

    <div class="mb-3">
        <label for="image_url" class="form-label">Image</label>
        <input type="file" class="form-control" id="image_url" name="image_url">
        <img src="<?= htmlspecialchars($habitat->image_url) ?>" alt="Image actuelle" width="100">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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