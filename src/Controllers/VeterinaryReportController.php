<?php
// Controllers/VeterinaryReportController.php

namespace App\Controllers;

use App\Models\VeterinaryReport;
use App\Config\SessionManager;
use App\Models\Animal;



class VeterinaryReportController
{
    // Afficher le formulaire pour ajouter un rapport vétérinaire
    public function createReport()
    {
        SessionManager::start();


            // Vérification des types de nourriture récupérés
$foodTypes = Animal::getDistinctFoodTypes();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'animal_id' => $_POST['animal_id'],
                'user_id' => SessionManager::get('user_id'), // Récupérer l'utilisateur connecté
                'last_checkup_date' => $_POST['last_checkup_date'],
                'health_status' => $_POST['health_status'],
                'food_given' => $_POST['food_given'],
                'food_quantity' => $_POST['food_quantity'],
                'additional_notes' => $_POST['additional_notes']
            ];


            // Ajouter le rapport via le modèle
            VeterinaryReport::add($data);

            // Rediriger après l'ajout du rapport
            header('Location: /index.php?controller=animal&action=showAnimalDetails&id=' . $_POST['animal_id']);
            exit;
        }

        // Récupérer l'ID de l'animal pour lequel ajouter le rapport
        $animal_id = $_GET['animal_id'];

    

        // Afficher la vue du formulaire d'ajout
        $view = __DIR__ . '/../../Views/admin/veterinary_reports/create_report.php';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }

    public function showReportDetails()
    {
        // Récupérer l'ID du rapport depuis la requête
        $reportId = isset($_GET['id']) ? $_GET['id'] : null;
    
        if (!$reportId) {
            echo "ID du rapport non spécifié.";
            return;
        }
    
        // Récupérer les détails du rapport vétérinaire
        $report = \App\Models\VeterinaryReport::getReportById($reportId);
    
        if (!$report) {
            echo "Rapport vétérinaire non trouvé.";
            return;
        }
    
        // Récupérer l'animal associé au rapport
        $animal = \App\Models\Animal::getById($report->animal_id);
    
        if (!$animal) {
            echo "Animal non trouvé.";
            return;
        }
    
        // Transmettre les données à la vue
        $view = __DIR__ . '/../../Views/admin/veterinary_reports/details_report.php';
        $pageTitle = 'Détails du Rapport Vétérinaire';
        
        // Inclure le template du dashboard en passant les données
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    
// src/Controllers/VeterinaryReportController.php
public function summaries()
{
    // Récupérer tous les derniers rapports de chaque animal
    $reports = VeterinaryReport::getLatestReportsForAnimalsWithFilters([]);

    // Transmettre les rapports à la vue
    $view = __DIR__ . '/../../Views/admin/veterinary_reports/summaries.php';
    $pageTitle = 'Résumé des Rapports Vétérinaires';

    require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
}


    public function getFilterOptions()
    {
        header('Content-Type: application/json');
        
        // Récupérer les filtres disponibles depuis la base de données
        $animalNames = VeterinaryReport::getDistinctAnimalNames();
        $animalRaces = VeterinaryReport::getDistinctAnimalRaces();
        $healthStatuses = VeterinaryReport::getDistinctHealthStatuses();

        echo json_encode([
            'animalNames' => $animalNames,
            'animalRaces' => $animalRaces,
            'healthStatuses' => $healthStatuses,
        ]);
    }

    public function getFilteredReports()
{
    header('Content-Type: application/json');

    // Récupérer les filtres appliqués
    $filters = json_decode(file_get_contents('php://input'), true);

    // Obtenir les derniers rapports pour chaque animal en utilisant les filtres si fournis
    $reports = VeterinaryReport::getLatestReportsForAnimalsWithFilters($filters);

    echo json_encode($reports);
}



}
