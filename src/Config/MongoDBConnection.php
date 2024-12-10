<?php
// src/Config/MongoDBConnection.php

namespace App\Config;

use MongoDB\Client;
use Throwable;

class MongoDBConnection {
    private $client;
    public function __construct() {
        try {
            // Charger l'URI depuis les variables d'environnements
            $uri = $_ENV['MONGO_URI'];
            if (empty($uri)) {
                throw new \Exception('MONGO_URI n\'est pas défini dans le fichier .env.');
            }

            $this->client = new Client($uri);
        } catch (Throwable $e) {
            // Log l'erreur en cas de problème de connexion
            error_log('Erreur de connexion MongoDB : ' . $e->getMessage());
            die('Erreur : Impossible de se connecter à MongoDB.');
        }
    }
// test MaJ 
    public function getDatabase(string $dbName) {
        if (empty($dbName)) {
            throw new \Exception('Le nom de la base de données n\'est pas défini.');
        }

        return $this->client->selectDatabase($dbName);
    }

    public function getCollection() {
        $dbName = $_ENV['MONGO_DB'];
        $collectionName = $_ENV['MONGO_COLLECTION'];

        if (empty($dbName) || empty($collectionName)) {
            throw new \Exception('MONGO_DB ou MONGO_COLLECTION n\'est pas défini dans le fichier .env.');
        }

        return $this->getDatabase($dbName)->selectCollection($collectionName);
    }
}
