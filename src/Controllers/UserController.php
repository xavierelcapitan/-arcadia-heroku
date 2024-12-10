<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\EmailService;

class UserController
{
    // Créer un utilisateur
    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            if (User::emailExists($email)) {
                echo "L'email est déjà utilisé. Veuillez choisir un autre email.";
                return;
            }
    
            // Autres champs de l'utilisateur
            $password = $_POST['password'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $role = $_POST['role'];
    
            // Ajouter l'utilisateur via le modèle
            User::add([
                'email' => $email,
                'password' => $password,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'role' => $role
            ]);
    
            // Rediriger après la création
            header('Location: /index.php?controller=user&action=listUsers');
            exit;
        }
    
        // Afficher le formulaire de création d'utilisateur
        $view = __DIR__ . '/../../Views/admin/users/create.php';
        $pageTitle = 'Ajouter un nouvel utilisateur';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    

    // Modifier un utilisateur
    public function editUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = User::find($id);

            if ($user) {
                $view = __DIR__ . '/../../Views/admin/users/edit.php';  
                $pageTitle = 'Modifier un utilisateur';
                require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
            } else {
                // Redirection si l'utilisateur n'existe pas
                header('Location: /index.php?controller=admin&action=users');
                exit;
            }
        } else {
            // Redirection si l'ID n'est pas passé
            header('Location: /index.php?controller=admin&action=users');
            exit;
        }
    }

    // Mettre à jour un utilisateur
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    
            $id = $_POST['id'];
    
            // Mettre à jour les données de l'utilisateur
            User::update($id, [
                'email' => $_POST['email'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'role' => $_POST['role']
            ]);
    
            // Redirection après mise à jour réussie
            header('Location: /index.php?controller=admin&action=users');
            exit;
        } else {
            // Redirection si la requête est incorrecte
            header('Location: /index.php?controller=admin&action=users');
            exit;
        }
    }
    

    // Supprimer un utilisateur
    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Suppression de l'utilisateur
                User::delete($id);
    
                // Redirection après suppression
                header('Location: /index.php?controller=admin&action=users');
                exit;
            } else {
                // Afficher la confirmation avant suppression
                $user = User::find($id);
                $view = __DIR__ . '/../../Views/admin/users/confirm_delete.php';  // Vue pour la confirmation
                require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
            }
        } else {
            // Redirection si l'ID est manquant
            header('Location: /index.php?controller=admin&action=users');
            exit;
        }
    }
    

    // Lister les utilisateurs
    public function listUsers()
    {
        $users = User::all();
        $view = __DIR__ . '/../../Views/admin/users/list.php';  
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';  
    }

    public function reviewModeration()
{
    $pendingReviews = Review::getPendingReviews();
    $view = __DIR__ . '/../../Views/admin/reviews/moderation.php';
    $pageTitle = "Modération des Avis";
    require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
}

public function approveReview()
{
    $reviewId = $_POST['review_id'];
    if (Review::approveReview($reviewId)) {
        $_SESSION['success'] = "L'avis a été approuvé.";
    } else {
        $_SESSION['error'] = "Impossible d'approuver l'avis. Veuillez réessayer.";
    }
    header("Location: /admin/reviews"); 
    exit();
}
}
