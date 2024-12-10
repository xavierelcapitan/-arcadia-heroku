<?php

namespace App\Controllers;

use App\Models\FeedingReport;
use App\Config\SessionManager;

class FeedingReportController
{

public function addReport()
{
    // Démarrer la session 
    SessionManager::start();

    // Récupérer l'ID de l'utilisateur connecté
    $user_id = SessionManager::get('user_id');

    // Vérifier si l'utilisateur est connecté
    if (!$user_id) {
        header('Location: /index.php?controller=auth&action=showLogin');
        exit;
    }

    // Récupérer l'ID de l'animal
    $animal_id = $_GET['animal_id'];

    // Ajouter un rapport de nourrissage
    FeedingReport::add([
        'animal_id' => $animal_id,
        'user_id' => $user_id, 
        'food_quantity' => $_POST['food_quantity'],
        'feeding_date' => $_POST['feeding_date'],
        'food_type_report' => $_POST['food_type_report'] // Assurez-vous que ce nom correspond à votre formulaire
    ]);

    var_dump($_POST);

    // Redirection après ajout
    header('Location: /index.php?controller=animal&action=showAnimalDetails&id=' . $animal_id);
    exit;
}
}