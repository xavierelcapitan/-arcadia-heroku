<!-- Views/admin/services/list.php -->

<a href="/index.php?controller=services&action=createService" class="btn btn-primary">Ajouter un Service</a>

<table class="table table-bordered table-striped mt-4">

    <thead>
        <tr>
            <th>Nom</th>
            <th>Emplacement</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service): ?>
            <tr>
                <td><?= htmlspecialchars($service->name) ?></td>
                
                <td><?= htmlspecialchars($service->location) ?></td>
                <td>
                    <?php if ($service->image_path): ?>
                        <img src="<?= htmlspecialchars($service->image_path) ?>" alt="Image de <?= htmlspecialchars($service->name) ?>" style="width: 50px; height: 50px;">
                    <?php else: ?>
                        Aucun
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/index.php?controller=services&action=editService&id=<?= $service->id ?>" class="btn btn-warning">Modifier</a>
                    <a href="/index.php?controller=services&action=deleteService&id=<?= $service->id ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
