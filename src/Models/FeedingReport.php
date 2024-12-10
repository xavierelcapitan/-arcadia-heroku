<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class FeedingReport extends Model
{
    // Ajouter un rapport de nourrissage
    public static function add($data)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("
            INSERT INTO feeding_reports (animal_id, user_id, food_quantity, feeding_date, food_type_report, created_at)
            VALUES (:animal_id, :user_id, :food_quantity, :feeding_date, :food_type_report, NOW())
        ");
        
        $stmt->execute([
            ':animal_id' => $data['animal_id'],
            ':user_id' => $data['user_id'],
            ':food_quantity' => $data['food_quantity'],
            ':feeding_date' => $data['feeding_date'],
            ':food_type_report' => $data['food_type_report']
        ]);
    }
    
    

    // Récupérer les rapports de nourrissage par ID d'animal
    public static function getByAnimalId($animal_id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare("
            SELECT fr.*, fr.food_type_report, u.first_name AS user_name
            FROM feeding_reports fr
            JOIN users u ON fr.user_id = u.id
            WHERE fr.animal_id = :animal_id
            ORDER BY fr.feeding_date DESC
        ");
        $stmt->execute(['animal_id' => $animal_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    
       // Méthode pour obtenir tous les rapports de nourriture d'un animal spécifique
       public static function getReportsByAnimalId($animalId)
       {
           $db = self::getDbInstance(); // Utilise la méthode héritée de Model
           $stmt = $db->prepare("SELECT * FROM feeding_reports WHERE animal_id = :animal_id ORDER BY feeding_date DESC");
           $stmt->bindParam(':animal_id', $animalId, PDO::PARAM_INT);
           $stmt->execute();
           
           return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourne tous les rapports sous forme d'objets
       }
}
