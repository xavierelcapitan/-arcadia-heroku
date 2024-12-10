document.addEventListener("DOMContentLoaded", function () {
    const statsContainer = document.getElementById("stats-cards");

    // Fonction pour créer une carte
    function createCard(title, value, colorClass) {
        const card = document.createElement("div");
        card.className = "col-md-3";
        card.innerHTML = `
            <div class="card text-center bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-${colorClass}">${title}</h5>
                    <p class="display-4">${value}</p>
                </div>
            </div>
        `;
        statsContainer.appendChild(card);
    }

    // Récupérer les données depuis l'API
    fetch("/index.php?controller=admin&action=getDashboardData")
        .then(response => response.json())
        .then(data => {
            // Ajouter les cartes statistiques
            createCard("Habitats", data.habitatCount, "success");
            createCard("Animaux", data.animalCount, "info");
            createCard("Clics total", data.totalClicks, "warning");
            createCard("Avis postés", data.reviewsCount, "danger");

            // Graphique : Top 3 animaux les plus vus
            const ctxTopAnimals = document.getElementById("top-animals-chart").getContext("2d");
            new Chart(ctxTopAnimals, {
                type: "bar",
                data: {
                    labels: data.topAnimals.map(a => a.name),
                    datasets: [{
                        label: "Vues",
                        data: data.topAnimals.map(a => a.views),
                        backgroundColor: ["#4CAF50", "#FF9800", "#F44336"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true, // Affiche le titre
                            text: 'Top 3 Animaux les Plus Vus', // Texte du titre
                            font: {
                                size: 16 // Taille de la police
                            }
                        },
                        legend: { display: false }
                    }
                }
            });

            // Graphique : Répartition des animaux par habitat
            const ctxHabitatDistribution = document.getElementById("habitat-distribution-chart").getContext("2d");
            new Chart(ctxHabitatDistribution, {
                type: "pie",
                data: {
                    labels: data.habitatDistribution.map(h => h.name),
                    datasets: [{
                        data: data.habitatDistribution.map(h => h.count),
                        backgroundColor: ["#4CAF50", "#8BC34A", "#FFEB3B"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true, // Affiche le titre
                            text: 'Répartition des Animaux par Habitat', // Texte du titre
                            font: {
                                size: 16 // Taille de la police
                            }
                        },
                        legend: { position: 'bottom' }
                    }
                }
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement des données du tableau de bord :", error);
        });
});
