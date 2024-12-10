<?php
// Models/Model.php
namespace App\Models;

use PDO;
use App\Config\Db;

class Model
{
    protected static $db;

    // Méthode statique pour récupérer l'instance de la base de données
    protected static function getDbInstance()
    {
        if (!self::$db) {
            // Connexion à la base de données via Db.php
            self::$db = Db::getInstance();
        }
        return self::$db;
    }
}

