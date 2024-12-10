<?php
// src/Controllers/HabitatReportController.php

namespace App\Controllers;

use App\Models\Habitat;
use App\Models\HabitatReport;
use App\Config\SessionManager;

class HabitatReportController
{
     // Méthode pour afficher les rapports vétérinaires d'un habitat
     public function showReports()
     {
         SessionManager::start();
     
         $habitat_id = $_GET['habitat_id'] ?? null;
     
         if (!$habitat_id) {
             echo "Habitat non trouvé.";
             return;
         }
     
         // Récupérer les détails de l'habitat
         $habitat = Habitat::findById($habitat_id);
     
         if (!$habitat) {
             echo "Habitat non trouvé.";
             return;
         }
     
         // Récupérer tous les rapports pour cet habitat
         $reports = HabitatReport::getReportsByHabitatId($habitat_id);
     
         // Définir la vue à inclure dans le template
         $view = __DIR__ . '/../../Views/admin/habitats/report.php';
     
         // Charger le layout avec la vue spécifique
         require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
     }
     



    // Méthode pour ajouter un nouveau rapport vétérinaire
    public function addReport()
    {
        SessionManager::start();
    
        $habitat_id = $_GET['habitat_id'] ?? null;
        $user_id = SessionManager::get('user_id'); // Récupérer l'ID de l'utilisateur connecté

    
        if (!$habitat_id) {
            echo "Habitat non trouvé.";
            return;
        }
    
        // Récupérer les détails de l'habitat
        $habitat = Habitat::findById($habitat_id);
    
        if (!$habitat) {
            echo "Habitat non trouvé.";
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'habitat_id' => $habitat_id,
                'vet_opinion' => $_POST['vet_opinion'],
                'improvements' => $_POST['improvements'],
                'user_id' => $user_id // Ajouter l'ID de l'utilisateur
            ];
    
            // Insérer le nouveau rapport dans la base de données
            HabitatReport::saveReport($data);
    
            // Redirection après l'insertion
            header('Location: /index.php?controller=habitatReport&action=showReports&habitat_id=' . $habitat_id);
            exit;
        }
    
        // Définir la vue à inclure dans le template et passer l'habitat à la vue
        $view = __DIR__ . '/../../Views/admin/habitats/add_report.php';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    
}
