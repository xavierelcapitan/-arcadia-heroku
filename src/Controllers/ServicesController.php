<?php
// src/Controllers/ServicesController.php

namespace App\Controllers;

use App\Models\Service;
use App\Config\SessionManager;

class ServicesController
{
    // Liste des services
    public function listServices()
    {
        // Vérifie que l'utilisateur est un administrateur
        SessionManager::start();
    
      // Logique de récupération des services
    $services = Service::getAll();
    $view = __DIR__ . '/../../Views/admin/services/list.php';
    $pageTitle = 'Liste des Services';
    require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
}

    // Création d'un service
    public function createService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Initialisation des données à insérer en base de données avec image_path défini à null par défaut
            $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'location' => $_POST['location'],
            'image_path' => $_POST['image_path'],
            'opening_time' => $_POST['opening_time'],
            'closing_time' => $_POST['closing_time'],
            'child_price' => $_POST['child_price'],
            'adult_price' => $_POST['adult_price'],
            'group_price' => $_POST['group_price'],
            'is_free' => isset($_POST['is_free']) ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
            ];
    
            // Gestion de l'image
            if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = __DIR__ . '/../../Public/assets/uploads/';
                
                // Crée le répertoire s'il n'existe pas
                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }
    
                // Génère un nom de fichier unique pour éviter les conflits
                $fileName = uniqid() . '_' . basename($_FILES['image_path']['name']);
                $targetFile = $targetDirectory . $fileName;
    
                // Déplace le fichier uploadé vers le dossier cible
                if (move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
                    // Définit le chemin de l'image pour l'enregistrement en base de données directement dans $data
                    $data['image_path'] = '/assets/uploads/' . $fileName;
                }
            }
    
            // Insertion des données dans la base de données
            Service::create($data);
            
            // Redirection après l'insertion
            header('Location: /index.php?controller=services&action=listServices');
            exit;
        }
    
        // Chargement de la vue de création
        $view = __DIR__ . '/../../Views/admin/services/create.php';
        $pageTitle = 'Ajouter un nouveau service';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    
    
    

    // Édition d'un service
    public function editService()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $service = Service::getById($id);
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Préparation des données de mise à jour
                $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'location' => $_POST['location'],
            'image_path' => $service->image_path ,
            'opening_time' => $_POST['opening_time'],
            'closing_time' => $_POST['closing_time'],
            'child_price' => $_POST['child_price'],
            'adult_price' => $_POST['adult_price'],
            'group_price' => $_POST['group_price'],
            'is_free' => isset($_POST['is_free']) ? 1 : 0
                ];
    
                // Gestion de l'image (si une nouvelle image est uploadée)
                if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
                    $targetDirectory = __DIR__ . '/../../Public/assets/uploads/';
                    
                    // Crée le répertoire s'il n'existe pas
                    if (!file_exists($targetDirectory)) {
                        mkdir($targetDirectory, 0777, true);
                    }
    
                    // Génère un nom de fichier unique pour éviter les conflits
                    $fileName = uniqid() . '_' . basename($_FILES['image_path']['name']);
                    $targetFile = $targetDirectory . $fileName;
    
                    // Déplace le fichier uploadé vers le dossier cible
                    if (move_uploaded_file($_FILES['image_path']['tmp_name'], $targetFile)) {
                        // Met à jour le chemin de l'image dans $data si le téléchargement réussit
                        $data['image_path'] = '/assets/uploads/' . $fileName;
    
                        // Supprime l'ancienne image du serveur si elle existe
                        if (!empty($service->image_path) && file_exists(__DIR__ . '/../../Public' . $service->image_path)) {
                            unlink(__DIR__ . '/../../Public' . $service->image_path);
                        }
                    }
                }
    
                // Mise à jour des données dans la base de données
                Service::update($id, $data);
                
                // Redirection après la mise à jour
                header('Location: /index.php?controller=services&action=listServices');
                exit;
            }
    
            // Charger la vue d'édition avec les données actuelles du service
            $view = __DIR__ . '/../../Views/admin/services/edit.php';
            $pageTitle = 'Modifier le service';
            require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
        } else {
            header('Location: /index.php?controller=services&action=listServices');
            exit;
        }
    }
    

    // Suppression d'un service
    public function deleteService()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Service::delete($id); // Utilisation de `delete`
            header('Location: /index.php?controller=services&action=listServices');
            exit;
        } else {
            header('Location: /index.php?controller=services&action=listServices'); // Redirection si l'ID n'est pas fourni
            exit;
        }
    }

// Détails d'un service
public function showServiceDetails()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $service = Service::getById($id);

        if (!$service) {
            // Si le service n'existe pas, rediriger
            header('Location: /index.php?controller=services&action=listServices');
            exit;
        }

        // Charger la vue des détails
        $view = __DIR__ . '/../../Views/pages/details_services.php';
        $pageTitle = $service->name; // Utilise le nom du service comme titre
        require_once __DIR__ . '/../../Views/layouts/default.php';
    } else {
        // Redirection si aucun ID n'est fourni
        header('Location: /index.php?controller=services&action=listServices');
        exit;
    }
}


}
