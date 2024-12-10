<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Admin CSS -->
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <div class="container-fluid">


        <!-- Cartes de statistiques -->
        <div id="stats-cards" class="row mb-4"></div>

        <!-- Graphiques -->
        <div class="row mb-4">
    <!-- Graphique : Top 3 Animaux les Plus Vus -->
    <div class="col-md-6">
        <div class="card shadow-sm chart-card">
            <div class="card-body">
                <canvas id="top-animals-chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Graphique : Répartition des Animaux par Habitat -->
    <div class="col-md-6">
        <div class="card shadow-sm chart-card">
            <div class="card-body">
                <canvas id="habitat-distribution-chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>


    </div>
    

</div>

    <!-- Script principal -->
    <script src="/assets/js/admin_dashboard.js"></script>
</body>
</html>
