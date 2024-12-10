<?php
// src/Controllers/AdminController.php


namespace App\Controllers;

use App\Models\User;
use App\Config\SessionManager; 
use App\Services\EmailService;
use App\Models\Habitat;
use App\Models\Reviews;
use App\Models\Animal;

class AdminController {

    // Méthode pour afficher le tableau de bord
    public function dashboard()
    {
        // Démarrer la session
        SessionManager::start();

        // Vérifier si l'utilisateur est connecté
        if (!SessionManager::has('user_id')) {
            // Rediriger vers la page de login si non connecté
            header('Location: /index.php?controller=auth&action=showLogin');
            exit;
        }

        // Si connecté, afficher le dashboard
        $view = __DIR__ . '/../../Views/admin/dashboard.php';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }


  // Méthode pour afficher la liste des utilisateurs
  public function users() {

    $users = User::all(); 
    $view = __DIR__ . '/../../Views/admin/users/list.php';
    $pageTitle = 'Gestion des Utilisateurs';
    require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
}




 // Méthode pour créer un utilisateur
 public function createUser()
 {
     SessionManager::start();

     // Vérifie que l'utilisateur est un admin
     if (SessionManager::get('role') !== 'admin') {
         header('Location: /index.php?controller=auth&action=showLogin');
         exit;
     }

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Création de l'utilisateur
         $userData = [
             'email' => $_POST['email'],
             'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
             'first_name' => $_POST['first_name'],
             'last_name' => $_POST['last_name'],
             'role' => $_POST['role']
         ];
         User::add($userData);

         // Envoi de l'email
         $siteUrl = 'https://votre_site.com';
         EmailService::sendAccountCreationEmail($_POST['email'], $_POST['first_name']);

         // Redirige après la création
         header('Location: /index.php?controller=admin&action=users');
         exit;
     }

     $view = __DIR__ . '/../../Views/admin/users/create.php';
     require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
 }


    // Méthode pour modifier un utilisateur
    public function editUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            User::update($id, $_POST);
            header('Location: /index.php?controller=admin&action=users');
        } else {
            $user = User::getById($id);
            $content = ""; 
            require_once __DIR__ . '/../../Views/admin/users/edit.php';
        }
    }

    // Méthode pour supprimer un utilisateur
    public function deleteUser($id) {
        User::delete($id);
        header('Location: /index.php?controller=admin&action=users');
    }


    
    // Récupérer les données du tableau de bord
    public function getDashboardData()
    {
        // Récupérer les statistiques depuis les modèles
        $habitatCount = Habitat::getCount();
        $animalCount = Animal::getCount();
        $totalClicks = Animal::getTotalViews();
        $topAnimals = Animal::getTopViewed(3);
        $reviewsCount = Reviews::getCount();
        $habitatDistribution = Habitat::getAnimalDistribution();

        // Retourner les données au format JSON
        echo json_encode([
            'habitatCount' => $habitatCount,
            'animalCount' => $animalCount,
            'totalClicks' => $totalClicks,
            'topAnimals' => $topAnimals,
            'reviewsCount' => $reviewsCount,
            'habitatDistribution' => $habitatDistribution,
        ]);
        exit; 
    }

}
