
    <div class="container my-5">
        <!-- Image pleine largeur -->
        <div class="service-image mb-4">
            <img src="<?= htmlspecialchars($service->image_path) ?>" alt="<?= htmlspecialchars($service->name) ?>" class="img-fluid w-100">
        </div>

        <!-- Nom et informations principales -->
        <h1 class="text-center mb-3"><?= htmlspecialchars($service->name) ?></h1>
        <p class="text-center"><strong>Lieu :</strong> <?= htmlspecialchars($service->location) ?></p>
        <p class="text-center">
            <strong>Horaires :</strong>
            <?= (new DateTime($service->opening_time))->format('H:i') ?> - <?= (new DateTime($service->closing_time))->format('H:i') ?>
        </p>

        <!-- Description -->
        <div class="service-description my-5">
            <h2>Description</h2>
            <div><?= $service->description ?></div>
        </div>

        <!-- Tarifs -->
        <?php if (!$service->is_free && ($service->child_price > 0 || $service->adult_price > 0 || $service->group_price > 0)): ?>
    <div class="service-prices mb-4">
        <h2>Tarifs</h2>
        <ul>
            <?php if ($service->child_price > 0): ?>
                <li><strong>Enfant :</strong> <?= htmlspecialchars($service->child_price) ?> €</li>
            <?php endif; ?>
            <?php if ($service->adult_price > 0): ?>
                <li><strong>Adulte :</strong> <?= htmlspecialchars($service->adult_price) ?> €</li>
            <?php endif; ?>
            <?php if ($service->group_price > 0): ?>
                <li><strong>Groupe :</strong> <?= htmlspecialchars($service->group_price) ?> €</li>
            <?php endif; ?>
        </ul>
    </div>
        <?php elseif ($service->is_free): ?>
            <p class="text-success"><strong>Ce service est gratuit.</strong></p>
        <?php endif; ?>

        </div>
        <!-- Retour -->
        <div class="text-center my-5">
          <a href="/index.php?controller=page&action=services" class="btn btn-secondary">Retour aux services</a>
        </div>

    </div>
