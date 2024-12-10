<a href="/index.php?controller=animal&action=createAnimal" class="btn btn-primary">Ajouter un animal</a>

<?php if (!empty($animals)) : ?>
    <table class="table">
        <thead>
            <tr>
           
                <th>Prénom</th>
                <th>Race</th>
                <th>Habitat</th>
                <th>Vues</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animals as $animal) : ?>
                <tr>
      
                    <td><?= htmlspecialchars($animal->name) ?></td>
                    <td><?= htmlspecialchars($animal->race) ?></td>
                    <td><?= htmlspecialchars($animal->habitat_name) ?></td>
                    <td><?php echo htmlspecialchars($animal->views ?? 0); ?></td>

                    <td>
                        <a href="/index.php?controller=animal&action=showAnimalDetails&id=<?= $animal->id ?>" class="btn btn-info">Détails</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Aucun animal trouvé.</p>
<?php endif; ?>
