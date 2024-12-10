<?php
// src/Controllers/MainController.php

namespace App\Controllers;

class MainController {
    public function index() {
        $view = __DIR__ . '/../../Views/home.php';  // Charge la vue home.php
        $pageTitle = 'Accueil'; 
        require_once __DIR__ . '/../../Views/layouts/default.php'; // Charge le layout pour les visiteurs
    }
}