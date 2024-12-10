<!-- Views/admin/habitats/add_report.php -->

<h1>Ajouter un Rapport Vétérinaire pour l'Habitat : <?= htmlspecialchars($habitat->name ?? 'Nom de l\'habitat non trouvé') ?></h1>

<form action="/index.php?controller=habitatReport&action=addReport&habitat_id=<?= htmlspecialchars($habitat->id) ?>" method="POST">
    <div class="form-group">
        <label for="vet_opinion">Avis du Vétérinaire</label>
        <textarea id="vet_opinion" name="vet_opinion" class="form-control tinymce" rows="5" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="improvements">Améliorations à Apporter</label>
        <textarea id="improvements" name="improvements" class="form-control tinymce" rows="5" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
    <a href="/index.php?controller=habitatReport&action=showReports&habitat_id=<?= htmlspecialchars($habitat->id) ?>" class="btn btn-secondary">Annuler</a>
</form>
