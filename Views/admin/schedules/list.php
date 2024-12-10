
<h1>Gestion des horaires</h1>
<table>
    <thead>
        <tr>
            <th>Jour</th>
            <th>Heure d'ouverture</th>
            <th>Heure de fermeture</th>
            <th>Fermé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?= $schedule['day'] ?></td>
                <td><?= $schedule['opening_time'] ?? '-' ?></td>
                <td><?= $schedule['closing_time'] ?? '-' ?></td>
                <td><?= $schedule['is_closed'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <a href="edit.php?day=<?= $schedule['day'] ?>">Modifier</a>
                    <a href="delete.php?day=<?= $schedule['day'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="form.php">Ajouter un horaire</a>
