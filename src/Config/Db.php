<?php

namespace App\Config;

use PDO;

class Db extends PDO
{
    private static $instance = null;

    private function __construct()
    {
        // Construction dynamique du DSN à partir des variables d'environnement
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];

        try {
            // Connexion à la base avec les informations provenant du .env
            parent::__construct($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
