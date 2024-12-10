<?php
// src/Controllers/Pages.php

namespace App\Controllers;

use App\Models\Service; 
use App\Models\Schedule; 

class PageController {
    // Méthode pour afficher la page des habitats
    public function habitats() {
        $view = __DIR__ . '/../../Views/pages/habitats.php';
        require_once __DIR__ . '/../../Views/layouts/default.php';
    }

    // Méthode pour afficher la page de contact
    public function contact() {
        $view = __DIR__ . '/../../Views/pages/contact.php';
        require_once __DIR__ . '/../../Views/layouts/default.php';
    }

    // Méthode pour afficher la page des services
    public function services() {
        $services = Service::getAll(); 
        $pageTitle = 'Nos Services'; 
        $view = __DIR__ . '/../../Views/pages/services.php';
        require_once __DIR__ . '/../../Views/layouts/default.php';
    }
    
    // Méthode pour afficher la page d'accueil
    public function home() {
        $scheduleModel = new Schedule(); 
        $schedules = $scheduleModel->getAllSchedules(); 
        $pageTitle = 'Accueil'; 
        $view = __DIR__ . '/../../Views/pages/home.php';
        require_once __DIR__ . '/../../Views/layouts/default.php';
    }
}



