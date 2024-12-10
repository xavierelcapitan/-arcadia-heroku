<?php
// Public/index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Config\Autoloader;
use Dotenv\Dotenv;

// Charger l'autoloader 
require_once __DIR__ . '/../src/Config/Autoloader.php';
require_once __DIR__ . '/../vendor/autoload.php';
Autoloader::register();

// Charger les variables d'environnement si le fichier .env existe
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// Récupérer le controller et l'action depuis l'URL (ou par défaut)
$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'MainController';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Ajouter le namespace au controller
$controller = 'App\\Controllers\\' . $controller;

try {
    // Vérifier si le contrôleur existe
    if (!class_exists($controller)) {
        http_response_code(404);
        throw new Exception("Contrôleur '$controller' non trouvé.");
    }

    $controllerInstance = new $controller();

    // Vérifier si l'action existe
    if (!method_exists($controllerInstance, $action)) {
        http_response_code(404);
        throw new Exception("Action '$action' non trouvée.");
    }

    // Appeler l'action
    $controllerInstance->$action();
} catch (Exception $e) {
    // Gestion des erreurs avec message
    error_log($e->getMessage());
    http_response_code(500);
    require_once __DIR__ . '/../Views/errors/500.php'; // Page d'erreur interne
}
