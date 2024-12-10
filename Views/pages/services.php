<div class="container my-5">
    <h1 class="text-center mb-4">Nos Services</h1>
    <div class="row">
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <img src="<?= htmlspecialchars($service->image_path) ?>" class="card-img-top" alt="<?= htmlspecialchars($service->name) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($service->name) ?></h5>
                        <p class="card-subtitle text-muted mb-2">
                            <span class="location-badge"><?= htmlspecialchars($service->location) ?></span>
                        </p>
                        <p class="card-text">
                            <strong>Horaires :</strong>
                            <?= (new DateTime($service->opening_time))->format('H:i') ?> - <?= (new DateTime($service->closing_time))->format('H:i') ?>
                        </p>

                    <a href="/index.php?controller=services&action=showServiceDetails&id=<?= $service->id ?>" class="btn btn-primary">Détails</a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
