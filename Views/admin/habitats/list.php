<!-- Views/admin/habitats/list.php -->

<a href="/index.php?controller=habitat&action=createHabitat" class="btn btn-primary mt-5">Ajouter un habitat</a>

<table class="table mt-5">
    <thead>
        <tr>

            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($habitats as $habitat) : ?>
            <tr>

                <td><?= htmlspecialchars($habitat->name) ?></td>

                <td>
                    <a href="/index.php?controller=habitat&action=editHabitat&id=<?= $habitat->id ?>" class="btn btn-warning">Modifier</a>
                    <form id="deleteForm-<?= $habitat->id ?>" method="POST" action="/index.php?controller=habitat&action=deleteHabitat&id=<?= $habitat->id ?>" style="display: none;">
                    </form>

                    <form id="deleteForm-<?= $habitat->id ?>" method="POST" action="/index.php?controller=habitat&action=deleteHabitat&id=<?= $habitat->id ?>" style="display: none;">
                    </form>

                    <a href="#"
                        class="btn btn-danger"
                        onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?')) { document.getElementById('deleteForm-<?= $habitat->id ?>').submit(); } return false;">
                        Supprimer
                    </a>

                    <a href="/index.php?controller=habitatReport&action=showReports&habitat_id=<?= htmlspecialchars($habitat->id) ?>" class="btn btn-info">Voir les rapports vétérinaires</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>