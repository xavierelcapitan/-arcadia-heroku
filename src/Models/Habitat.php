<?php
// Models/Habitat.php

namespace App\Models;
use App\Models\Model;
use PDO;

class Habitat extends Model
{

    protected static $table = 'habitats';

    // Récupérer tous les habitats
    public static function all()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query('SELECT * FROM habitats');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Récupérer un habitat par ID
    public static function find($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('SELECT * FROM habitats WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

       // Méthode pour récupérer un habitat par son ID
       public static function findById($id)
       {
           $db = self::getDbInstance();
           $stmt = $db->prepare("SELECT * FROM habitats WHERE id = :id");
           $stmt->execute(['id' => $id]);
           return $stmt->fetch(PDO::FETCH_OBJ);
       }

    // Ajouter un habitat
    public static function add($data)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('INSERT INTO habitats (name, description, image_url) VALUES (:name, :description, :image_url)');
        return $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':image_url' => $data['image_url']
        ]);
    }
    
    public static function update($id, $data)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('UPDATE habitats SET name = :name, description = :description, image_url = :image_url WHERE id = :id');
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':image_url' => $data['image_url']
        ]);
    }
    

    // Supprimer un habitat
    public static function delete($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('DELETE FROM habitats WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    
 // Méthode pour récupérer tous les habitats avec le nombre d'espèces
 public static function getHabitatsWithSpeciesCount()
 {
     $db = (new self())->getDbInstance();
     $stmt = $db->query("
         SELECT h.*, COUNT(a.id) AS species_count 
         FROM habitats h
         LEFT JOIN animals a ON a.habitat_id = h.id
         GROUP BY h.id
     ");
     return $stmt->fetchAll(PDO::FETCH_OBJ);
 }

 public static function getCount()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT COUNT(*) AS count FROM habitats");
        return $stmt->fetch(PDO::FETCH_OBJ)->count;
    }

    public static function getAnimalDistribution() {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT h.name, COUNT(a.id) as count FROM habitats h LEFT JOIN animals a ON h.id = a.habitat_id GROUP BY h.name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
