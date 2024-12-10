<!-- Views/admin/habitats/report.php -->
<h3>Rapports Vétérinaires pour l'Habitat : <?= htmlspecialchars($habitat->name ?? 'Nom de l\'habitat non trouvé') ?></h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Avis</th>
            <th>Améliorations à Apporter</th>
            <th>Date</th>
          
            
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($reports)): ?>
            <?php foreach ($reports as $report): ?>
                <tr>
                <td><?= htmlspecialchars($report->first_name) ?></td>
                    <td><?= $report->vet_opinion ?></td>
                    <td><?= $report->improvements ?></td>
                    
                    <td><?= date('d-m-y', strtotime($report->created_at)) ?></td>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Aucun rapport disponible pour cet habitat.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="/index.php?controller=habitatReport&action=addReport&habitat_id=<?= htmlspecialchars($habitat->id) ?>" class="btn btn-primary">Ajouter un rapport</a>
<a href="/index.php?controller=habitat&action=listHabitats" class="btn btn-secondary">Retour</a>
