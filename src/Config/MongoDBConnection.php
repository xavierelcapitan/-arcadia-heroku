<?php
// src/Config/MongoDBConnection.php

namespace App\Config;

use MongoDB\Client;
use Throwable;

class MongoDBConnection {
    private $client;

    public function __construct() {
        try {
            $this->client = new \MongoDB\Client($_ENV['MONGO_URI']);
            $this->db = $this->client->selectDatabase($_ENV['MONGO_DB']);
            // Test simple pour vérifier la connexion
            $this->db->listCollections();
            echo "Connexion à MongoDB réussie.";
        } catch (\Exception $e) {
            echo "Erreur de connexion à MongoDB : " . $e->getMessage();
            exit; // Arrête le script si la connexion échoue
        }
    }
    

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
