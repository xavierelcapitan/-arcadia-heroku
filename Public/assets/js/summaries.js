// Public/assets/js/summaries.js

document.addEventListener("DOMContentLoaded", function () {
    fetch('/index.php?controller=veterinaryReport&action=getFilterOptions')
        .then(response => response.json())
        .then(data => {
            populateFilterOptions('animalName', data.animalNames);
            populateFilterOptions('animalRace', data.animalRaces);
            populateFilterOptions('healthStatus', data.healthStatuses);
            loadReports(); // Charger tous les rapports au début
        })
        .catch(error => console.error('Erreur:', error));
});

function populateFilterOptions(selectId, options) {
    const select = document.getElementById(selectId);
    options.forEach(option => {
        const opt = document.createElement('option');
        opt.value = option;
        opt.textContent = option;
        select.appendChild(opt);
    });
}

function applyFilters() {
    const filters = {
        animalName: document.getElementById('animalName').value,
        animalRace: document.getElementById('animalRace').value,
        reportDate: document.getElementById('reportDate').value,
        healthStatus: document.getElementById('healthStatus').value,
        noReport: document.getElementById('noReportCheckbox').checked // Ajout du filtre "Aucun rapport"
    };

    fetch('/index.php?controller=veterinaryReport&action=getFilteredReports', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(filters)
    })
    .then(response => response.json())
    .then(data => updateTableRows(data))
    .catch(error => console.error('Erreur:', error));
}

function updateTableRows(reports) {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
    if (reports.length > 0) {
        reports.forEach(report => {
            const row = document.createElement('tr');
            const reportDate = report.last_checkup_date ? new Date(report.last_checkup_date).toLocaleDateString('fr-FR') : "Aucun rapport";
            const healthStatus = report.health_status || "Aucun rapport";

            // Définir l'URL du bouton "Détails" selon la présence ou non du rapport
            const detailsUrl = report.last_checkup_date
                ? `/index.php?controller=veterinaryReport&action=showReportDetails&id=${report.report_id}`
                : `/index.php?controller=animal&action=showAnimalDetails&id=${report.animal_id}`;

            row.innerHTML = `
                <td>${report.animal_name}</td>
                <td>${report.animal_race}</td>
                <td>${report.habitat_name}</td>
                <td>${reportDate}</td>
                <td>${healthStatus}</td>
                <td><a href="${detailsUrl}" class="btn btn-info btn-sm">Détails</a></td>
            `;
            tableBody.appendChild(row);
        });
    } else {
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center">Aucun rapport trouvé</td></tr>';
    }
}

function resetFilters() {
    document.getElementById('filterForm').reset();
    applyFilters(); // Recharge les données sans aucun filtre appliqué
}

function loadReports() {
    // Charger les rapports initiaux
    fetch('/index.php?controller=veterinaryReport&action=getFilteredReports', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => updateTableRows(data))
    .catch(error => console.error('Erreur:', error));
}
