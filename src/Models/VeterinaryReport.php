<?php

// src/Models/VeterinaryReport.php

namespace App\Models;

use PDO;
use App\Models\Model;

class VeterinaryReport extends Model
{
    protected static $table = 'veterinary_reports';

    // Récupérer les rapports vétérinaires par ID d'animal
    public static function getByAnimalId($animal_id)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("
            SELECT vr.*, u.first_name AS user_name
            FROM veterinary_reports vr
            JOIN users u ON vr.user_id = u.id
            WHERE vr.animal_id = :animal_id
            ORDER BY vr.last_checkup_date DESC
        ");
        $stmt->execute([':animal_id' => $animal_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Méthode pour obtenir tous les rapports d'un animal spécifique
    public static function getReportsByAnimalId($animalId)
    {
        $db = self::getDbInstance(); // Appel cohérent à la méthode statique
        $stmt = $db->prepare("SELECT * FROM veterinary_reports WHERE animal_id = :animal_id ORDER BY last_checkup_date DESC");
        $stmt->bindParam(':animal_id', $animalId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourne tous les rapports sous forme d'objets
    }
    

    // Ajouter un rapport vétérinaire
    public static function add($data)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("
            INSERT INTO veterinary_reports (animal_id, user_id, last_checkup_date, health_status, food_given, food_quantity, additional_notes, created_at)
            VALUES (:animal_id, :user_id, :last_checkup_date, :health_status, :food_given, :food_quantity, :additional_notes, NOW())
        ");
        
        $stmt->execute([
            ':animal_id' => $data['animal_id'],
            ':user_id' => $data['user_id'],
            ':last_checkup_date' => $data['last_checkup_date'],
            ':health_status' => $data['health_status'],
            ':food_given' => $data['food_given'],
            ':food_quantity' => $data['food_quantity'],
            ':additional_notes' => $data['additional_notes']  
        ]);
    }

    public static function getReportById($id)
{
    $db = (new self())->getDbInstance();
    $stmt = $db->prepare("SELECT * FROM veterinary_reports WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

public static function getLatestReportsForAnimals()
{
    $db = self::getDbInstance();
    $stmt = $db->query("
        SELECT vr.*, a.name AS animal_name, a.race AS animal_race, h.name AS habitat_name
        FROM veterinary_reports vr
        JOIN animals a ON vr.animal_id = a.id
        JOIN habitats h ON a.habitat_id = h.id
        WHERE (vr.animal_id, vr.last_checkup_date) IN (
            SELECT animal_id, MAX(last_checkup_date)
            FROM veterinary_reports
            GROUP BY animal_id
        )
        ORDER BY vr.last_checkup_date DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public static function getDistinctAnimalNames()
{
    $db = self::getDbInstance();
    $stmt = $db->query("SELECT DISTINCT name FROM animals");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public static function getDistinctAnimalRaces()
{
    $db = self::getDbInstance();
    $stmt = $db->query("SELECT DISTINCT race FROM animals");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public static function getDistinctHealthStatuses()
{
    $db = self::getDbInstance();
    $stmt = $db->query("SELECT DISTINCT health_status FROM veterinary_reports");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}




public static function getLatestReportsForAnimalsWithFilters($filters)
{
    $db = self::getDbInstance();
    $query = "
        SELECT a.id AS animal_id, a.name AS animal_name, a.race AS animal_race, h.name AS habitat_name,
               vr.last_checkup_date, vr.health_status, vr.id AS report_id
        FROM animals a
        LEFT JOIN veterinary_reports vr ON vr.animal_id = a.id
        LEFT JOIN habitats h ON a.habitat_id = h.id
    ";
    
    $conditions = [];
    $params = [];

    // Filtrer par nom de l'animal
    if (!empty($filters['animalName'])) {
        $conditions[] = "a.name LIKE :animalName";
        $params[':animalName'] = '%' . $filters['animalName'] . '%';
    }

    // Filtrer par race de l'animal
    if (!empty($filters['animalRace'])) {
        $conditions[] = "a.race LIKE :animalRace";
        $params[':animalRace'] = '%' . $filters['animalRace'] . '%';
    }

    // Filtrer par date du rapport
    if (!empty($filters['reportDate'])) {
        $conditions[] = "vr.last_checkup_date = :reportDate";
        $params[':reportDate'] = $filters['reportDate'];
    }

    // Filtrer par état de santé
    if (!empty($filters['healthStatus'])) {
        $conditions[] = "vr.health_status = :healthStatus";
        $params[':healthStatus'] = $filters['healthStatus'];
    }

    // Filtrer pour afficher uniquement les animaux sans rapport
    if (!empty($filters['noReport']) && $filters['noReport'] === true) {
        $conditions[] = "vr.id IS NULL";  // L'animal n'a pas de rapport
    }

    // Ajouter les conditions au query
    if ($conditions) {
        $query .= ' WHERE ' . implode(' AND ', $conditions);
    }

    // Récupérer les résultats
    $query .= " GROUP BY a.id ORDER BY vr.last_checkup_date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public static function getLatestByAnimalId($animalId)
{
    $db = (new self())->getDbInstance();
    $stmt = $db->prepare("SELECT * FROM veterinary_reports WHERE animal_id = :animal_id ORDER BY last_checkup_date DESC LIMIT 1");
    $stmt->bindParam(':animal_id', $animalId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_OBJ); // Retourne un objet contenant le dernier rapport
}

}
