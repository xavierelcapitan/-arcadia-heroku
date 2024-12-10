<?php

namespace App\Models;

use PDO;

class Race extends Model
{
    protected static $table = 'races';

    // Récupérer toutes les races
    public static function all()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query('SELECT * FROM races');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ajouter une nouvelle race
    public static function add($name)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('INSERT INTO races (name) VALUES (:name)');
        $stmt->execute([':name' => $name]);
    }
}
