<?php
// src/Controllers/MainController.php

namespace App\Controllers;

use App\Models\Schedule;

class MainController {
    public function index() {
        $scheduleModel = new Schedule(); 
        $schedules = $scheduleModel->getAllSchedules();

        // Vérifiez le jour actuel
        $today = date('l'); // Exemple : "Monday"
        echo "Jour actuel : " . $today . "<br>";

        // Vérifiez les horaires récupérés
        echo "<pre>";
        print_r($schedules);
        echo "</pre>";

        // Le jour actuel
        $today = date('l'); 

        // Trouvez l'horaire pour aujourd'hui
        $todaySchedule = array_filter($schedules, function ($schedule) use ($today) {
            return $schedule['day'] === $today;
        });

        $todaySchedule = reset($todaySchedule); // Récupère le premier résultat (ou null si vide)

        // Variables à transmettre à la vue
        $view = __DIR__ . '/../../Views/home.php';  // Charge la vue home.php
        $pageTitle = 'Accueil'; 
        require_once __DIR__ . '/../../Views/layouts/default.php'; // Charge le layout pour les visiteurs
    }
}
