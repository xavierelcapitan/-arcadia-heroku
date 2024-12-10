<?php
// Config/Controllers/dashboard.php

namespace App\Controllers;

use App\Models\Animal;
use App\Models\Habitat;
use App\Models\Reviews;

class AdminController
{
    public function dashboard()
    {
        // Récupération des données dynamiques
        $habitatCount = Habitat::getCount(); // Total des habitats
        $animalCount = Animal::getCount(); // Total des animaux
        $totalClicks = Animal::getTotalViews(); // Total des clics pour tous les animaux
        $topAnimals = Animal::getTopViewed(3); // Top 3 animaux les plus vus
        $reviewsCount = Reviews::getCount(); // Total des avis postés
        $habitatDistribution = Habitat::getAnimalDistribution(); // Répartition des animaux par habitat

        // Transmission des données à la vue
        $view = __DIR__ . '/../Views/admin/dashboard.php';
        $pageTitle = 'Tableau de bord';
        require_once __DIR__ . '/../Views/layouts/templatedashboard.php';
    }
}
