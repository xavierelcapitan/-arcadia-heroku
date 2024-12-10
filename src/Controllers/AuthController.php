<?php

// AuthController.php
namespace App\Controllers;

use App\Models\User;
use App\Config\SessionManager; 

class AuthController
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifier l'utilisateur dans la base de données
            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                // Utilisation de SessionManager pour stocker les données de session
                SessionManager::set('user_id', $user->id);
                SessionManager::set('user_role', $user->role);
                SessionManager::set('user_email', $user->email);

                // Rediriger vers le dashboard après connexion
                header('Location: /index.php?controller=admin&action=dashboard');
                exit;
            } else {
                // Si les identifiants sont incorrects, rediriger vers la page de connexion avec un message d'erreur
                header('Location: /index.php?controller=auth&action=showLogin&error=invalid_credentials');
                exit;
            }
        }
    }

   // Méthode pour afficher la page de login
   public function showLogin()
   {
       $view = __DIR__ . '/../../Views/auth/login.php'; // Charger la page de connexion
       require_once __DIR__ . '/../../Views/layouts/default.php'; // Layout principal (par exemple, default.php)
   }

   // Méthode pour se déconnecter
   public function logout()
   {
       SessionManager::destroy();
       header('Location: /index.php?controller=auth&action=showLogin');
       exit;
   }
}
