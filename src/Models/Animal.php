<?php

namespace App\Models;

use PDO;
use App\Models\Model;

class Animal extends Model
{
    protected static $table = 'animals'; // Associer la table "animals"

     // Méthode pour récupérer toutes les races distinctes depuis la table animals
     public static function getDistinctRaces()
     {
         $db = (new self())->getDbInstance();
         $stmt = $db->query("SELECT DISTINCT race FROM animals WHERE race IS NOT NULL AND race != ''");
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

     public static function getAnimalById($id)
{
    $db = (new self())->getDbInstance();
    $stmt = $db->prepare("SELECT * FROM animals WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

 // Récupérer les types de nourriture distincts de la table animals
 public static function getDistinctFoodTypes()
 {
     $db = self::getDbInstance();
     $stmt = $db->query("SELECT DISTINCT food_type FROM animals");
     return $stmt->fetchAll(PDO::FETCH_OBJ);
 }

    // Récupérer tous les animaux
    public static function all()
    {
        $db = (new self())->getDbInstance(); // Appel non statique comme dans Habitat
        $stmt = $db->query('SELECT * FROM animals');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Récupérer un animal par son ID
    public static function find($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('SELECT * FROM animals WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

       // Récupérer TOUS les animaux avec le nom des habitats
   public static function allWithHabitatName()
   {
       $db = (new self())->getDbInstance();
       $stmt = $db->query("
           SELECT animals.*, habitats.name AS habitat_name
           FROM animals
           JOIN habitats ON animals.habitat_id = habitats.id
       ");
       return $stmt->fetchAll(PDO::FETCH_OBJ);
   }
   
   // récupère UN SEUL animal avec l'habitat spécifique par son ID => pages de détails ou de modification.
   public static function findWithHabitat($id)
   {
       $db = (new self())->getDbInstance();
       $stmt = $db->prepare('
           SELECT animals.*, habitats.name AS habitat_name
           FROM animals
           JOIN habitats ON animals.habitat_id = habitats.id
           WHERE animals.id = :id
       ');
       $stmt->execute([':id' => $id]);
       return $stmt->fetch(PDO::FETCH_OBJ);
   }

   // Récupérer tous les animaux d'un habitat spécifique
public static function findAllByHabitat($habitatId)
{
    $db = (new self())->getDbInstance();
    $stmt = $db->prepare('
        SELECT id, name, race, image_url
        FROM animals
        WHERE habitat_id = :habitat_id
    ');
    $stmt->execute([':habitat_id' => $habitatId]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

    // Ajouter un nouvel animal
    public static function add($data)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare("
            INSERT INTO animals (name, race, age, weight, description, habitat_id, food_type, food_quantity, image_url, created_at)
            VALUES (:name, :race, :age, :weight, :description, :habitat_id, :food_type, :food_quantity, :image_url, NOW())
        ");
        $stmt->execute($data);
    }

    public static function getById($id)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("SELECT * FROM animals WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // Mettre à jour un animal
    public static function update($id, $data)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare("
            UPDATE animals 
            SET name = :name, race = :race, age = :age, description = :description, weight = :weight, habitat_id = :habitat_id, 
                food_type = :food_type, food_quantity = :food_quantity, image_url = :image_url
            WHERE id = :id
        ");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    // Supprimer un animal
    public static function delete($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('DELETE FROM animals WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public static function updateViews($id, $newViews)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("UPDATE animals SET views = :views WHERE id = :id");
        $stmt->execute(['views' => $newViews, 'id' => $id]);
    }
    
 
    public static function getCount()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT COUNT(*) AS count FROM animals");
        return $stmt->fetch(PDO::FETCH_OBJ)->count;
    }

    public static function getTotalViews()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT SUM(views) AS total FROM animals");
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }

    public static function getTopViewed(int $limit)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare("SELECT name, views FROM animals ORDER BY views DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    
 
}



