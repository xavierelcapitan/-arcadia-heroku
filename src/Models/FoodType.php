<?php

namespace App\Models;

class FoodType extends Model
{
    public static function add($foodType)
    {
        $db = self::getDbInstance();  // Appel de la méthode statique
        $stmt = $db->prepare("INSERT INTO food_types (food_type) VALUES (:food_type)");
        $stmt->bindParam(':food_type', $foodType);
        $stmt->execute();
    }
}
