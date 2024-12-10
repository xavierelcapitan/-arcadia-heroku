<!-- Views/admin/veterinary_reports/summaries.php -->

<!-- Formulaire de filtres -->
<form id="filterForm" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <select id="animalName" class="form-control">
                <option value="">Nom de l'animal</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="animalRace" class="form-control">
                <option value="">Race de l'animal</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" id="reportDate" class="form-control" placeholder="Date du rapport">
        </div>
        <div class="col-md-3">
            <select id="healthStatus" class="form-control">
                <option value="">État de santé</option>
            </select>
        </div>
    </div>
    <div class="form-check mt-3">
        <input type="checkbox" class="form-check-input" id="noReportCheckbox">
        <label class="form-check-label" for="noReportCheckbox">Aucun rapport</label>
    </div>
    <button type="button" class="btn btn-primary mt-3" onclick="applyFilters()">Filtrer</button>
    <button type="button" class="btn btn-secondary mt-3" onclick="resetFilters()">Réinitialiser</button>
</form>

<!-- Tableau des rapports -->
<div id="reportTable">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nom de l'animal</th>
                <th>Race</th>
                <th>Habitat</th>
                <th>Date du rapport</th>
                <th>État de santé</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- JavaScript INPUT-->
        </tbody>
    </table>
</div>

<script src="/assets/js/summaries.js"></script>
