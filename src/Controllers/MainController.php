<?php
// src/Controllers/MainController.php

namespace App\Controllers;

use App\Models\Schedule;

class MainController {
    public function index() {

        
$scheduleModel = new Schedule(); 
$schedules = $scheduleModel->getAllSchedules();

// Le jour actuel
$today = date('l'); 

// Trouvez l'horaire pour aujourd'hui
$todaySchedule = array_filter($schedules, function ($schedule) use ($today) {
    return strtolower($schedule['day']) === strtolower($today);
});

if (empty($todaySchedule)) {
    echo "Aucun horaire trouvé pour le jour : " . $today;
}


$todaySchedule = reset($todaySchedule); // Récupère le premier résultat (ou null si vide)

foreach ($schedules as $schedule) {
    echo "Jour dans MongoDB : " . $schedule['day'] . "<br>";
}

        // Variables à transmettre à la vue
        $view = __DIR__ . '/../../Views/home.php';  // Charge la vue home.php
        $pageTitle = 'Accueil'; 
        require_once __DIR__ . '/../../Views/layouts/default.php'; // Charge le layout pour les visiteurs
    }
}

