<?php
// AnimalController.php
namespace App\Controllers;

use App\Models\Animal;
use App\Models\Habitat;
use App\Models\FoodType;
use App\Models\FeedingReport;
use App\Models\VeterinaryReport;
use App\Models\User;
use App\Config\SessionManager;
use PDO;

class AnimalController
{
    // Afficher la liste des animaux
    public function listAnimals()
    {
        // Récupérer tous les animaux avec leur habitat
        $animals = Animal::allWithHabitatName();

        if ($animals) {
            $view = __DIR__ . '/../../Views/admin/animals/list.php';
            $pageTitle = 'Liste des animaux';
            require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
        } else {
            echo "Aucun animal trouvé.";
        }
    }

    // Créer un nouvel animal
    public function createAnimal()
    {
        $habitats = Habitat::all();
        $races = Animal::getDistinctRaces();
        $foodTypes = Animal::getDistinctFoodTypes();
        $errors = [];
        $imageUrl = null;
    
        // Si la requête est POST (soumission du formulaire)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newFoodType = trim($_POST['new_food_type']);
            $newRace = trim($_POST['new_race']);
    
            // Validation de base des champs
            if (empty($_POST['name'])) {
                $errors[] = "Le nom de l'animal est obligatoire.";
            }
            if (empty($_POST['age']) || !is_numeric($_POST['age'])) {
                $errors[] = "L'âge de l'animal est obligatoire et doit être un nombre.";
            }
            if (empty($_POST['weight']) || !is_numeric($_POST['weight'])) {
                $errors[] = "Le poids de l'animal est obligatoire et doit être un nombre.";
            }
    
            // Sélection ou ajout du type de nourriture
            if (!empty($newFoodType)) {
                $selectedFoodType = $newFoodType;
            } else {
                $selectedFoodType = $_POST['food_type'];
            }
    
            // Sélection ou ajout de la race
            if (!empty($newRace)) {
                $selectedRace = $newRace;  // Utiliser la nouvelle race
            } else {
                $selectedRace = $_POST['race'];  // Utiliser la race sélectionnée
            }
    
            // Gestion de l'image (facultatif)
            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = __DIR__ . '/../../Public/assets/uploads/';
                $fileName = basename($_FILES['image_url']['name']);
                $targetFile = $targetDirectory . $fileName;
    
                if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
                    $imageUrl = '/assets/uploads/' . $fileName;
                } else {
                    $errors[] = 'Erreur lors de l\'upload de l\'image.';
                }
            }
    
            // S'il n'y a pas d'erreurs, on ajoute l'animal avec la race sélectionnée ou saisie
            if (empty($errors)) {
                Animal::add([
                    'name' => $_POST['name'],
                    'race' => $selectedRace,  // Utilisation correcte de la race
                    'age' => $_POST['age'],
                    'weight' => $_POST['weight'],
                    'habitat_id' => $_POST['habitat_id'],
                    'food_type' => $selectedFoodType,
                    'food_quantity' => $_POST['food_quantity'],
                    'image_url' => $imageUrl,
                    'description' => $_POST['description'],

                ]);
    
                // Redirection après la création
                header('Location: /index.php?controller=animal&action=listAnimals');
                exit;
            }
        }
    
        // Transmettre les variables à la vue
        $view = __DIR__ . '/../../Views/admin/animals/create.php';
        $pageTitle = 'Ajouter un nouvel animal';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    


    // Modifier un animal existant
    public function editAnimal()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $animal = Animal::findWithHabitat($id);
            $habitats = Habitat::all();
            $errors = [];
            $imageUrl = $animal->image_url; // Garder l'image actuelle par défaut

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validation des champs
                if (empty($_POST['name'])) {
                    $errors[] = "Le nom de l'animal est obligatoire.";
                }
                if (empty($_POST['age']) || !is_numeric($_POST['age'])) {
                    $errors[] = "L'âge de l'animal est obligatoire et doit être un nombre.";
                }
                if (empty($_POST['weight']) || !is_numeric($_POST['weight'])) {
                    $errors[] = "Le poids de l'animal est obligatoire et doit être un nombre.";
                }

                // Vérifier si un nouveau fichier a été téléchargé
                if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    $fileMimeType = mime_content_type($_FILES['image_url']['tmp_name']);
                    $maxFileSize = 3 * 1024 * 1024; // 3 Mo

                    // Vérifier le type MIME
                    if (!in_array($fileMimeType, $allowedMimeTypes)) {
                        $errors[] = 'Format d\'image non autorisé. Formats acceptés : jpg, jpeg, png, webp.';
                    }

                    // Vérifier la taille du fichier
                    if ($_FILES['image_url']['size'] > $maxFileSize) {
                        $errors[] = 'La taille du fichier ne doit pas dépasser 3Mo.';
                    }

                    // Si aucune erreur, procéder à l'upload
                    if (empty($errors)) {
                        $targetDirectory = __DIR__ . '/../../Public/assets/uploads/';
                        $fileName = basename($_FILES['image_url']['name']);
                        $targetFile = $targetDirectory . $fileName;

                        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
                            $imageUrl = '/assets/uploads/' . $fileName; // Mettre à jour l'image si une nouvelle image est téléchargée
                        } else {
                            $errors[] = 'Erreur lors de l\'upload de l\'image.';
                        }
                    }
                }

                // Si aucune erreur, mettre à jour l'animal
                if (empty($errors)) {
                    Animal::update($id, [
                        'name' => $_POST['name'],
                        'race' => $_POST['race'],
                        'age' => $_POST['age'],
                        'weight' => $_POST['weight'],
                        'habitat_id' => $_POST['habitat_id'],
                        'food_type' => $_POST['food_type'],
                        'food_quantity' => $_POST['food_quantity'],
                        'image_url' => $imageUrl,
                        'description' => $_POST['description'],

                    ]);

                    header('Location: /index.php?controller=animal&action=listAnimals');
                    exit;
                }
            }

            $view = __DIR__ . '/../../Views/admin/animals/edit.php';
            $pageTitle = "Modifer : $animal->name";
            require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
        } else {
            header('Location: /index.php?controller=animal&action=listAnimals');
            exit;
        }
    }

    // Supprimer un animal
    public function deleteAnimal()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                Animal::delete($id);
                header('Location: /index.php?controller=animal&action=listAnimals');
                exit;
            }
        } else {
            header('Location: /index.php?controller=animal&action=listAnimals');
            exit;
        }
    }

    // Afficher les détails d'un animal et ses rapports vétérinaires
    public function showAnimalDetails()
    {
        // Démarrer la session si nécessaire
        SessionManager::start();
    
        // Vérifier si l'ID de l'animal est bien fourni
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: /index.php?controller=animal&action=listAnimals');
            exit;
        }
    
        $animal_id = $_GET['id'];
    
        // Récupérer l'animal avec son habitat
        $animal = Animal::findWithHabitat($animal_id);
    
        if (!$animal) {
            header('Location: /index.php?controller=animal&action=listAnimals');
            exit;
        }
    
        // Récupérer les types de nourriture associés
        $foodTypes = Animal::getDistinctFoodTypes();
    
        // Récupérer les rapports vétérinaires
        $veterinary_reports = VeterinaryReport::getByAnimalId($animal_id);
    
        // Récupérer les rapports de nourriture pour cet animal
$feeding_reports = FeedingReport::getByAnimalId($animal->id);
    
        // Récupérer l'utilisateur connecté
        $user_id = SessionManager::get('user_id');
        if (!$user_id) {
            header('Location: /index.php?controller=auth&action=showLogin');
            exit;
        }
    
        // Récupérer les informations de l'utilisateur
        $user = User::find($user_id);
    
         // Transmettre les données à la vue
        $view = __DIR__ . '/../../Views/admin/animals/details.php';
        $pageTitle = "Tous les détails de : $animal->name";
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
    
    public function reports() {
        // Utilise la méthode existante pour obtenir les derniers rapports par animal
        $reports = VeterinaryReport::getLatestReportsForAnimals();

        // Définir le chemin de la vue
        $view = __DIR__ . '/../../Views/admin/veterinary_reports/summaries.php';
        $pageTitle = 'Résumé des Rapports Vétérinaires';
        
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }

    public function showSummaries() {
        $reports = VeterinaryReport::getLatestReportsForAnimals();
        $view = __DIR__ . '/../../Views/admin/veterinary_reports/summaries.php';
        $pageTitle = 'Résumé des Rapports Vétérinaires';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }

}


    
      