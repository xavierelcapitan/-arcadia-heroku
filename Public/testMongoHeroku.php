<?php
// Public/testMongoHeroku.php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;   // Utilisation de PHP dotenv
use MongoDB\Client;

// Charger les variables depuis le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    // Utilisation des variables MONGO_URI et MONGO_DB depuis .env
    $mongoUri = $_ENV['MONGO_URI'];
    $databaseName = $_ENV['MONGO_DB'];

    // Connexion au serveur MongoDB
    $client = new Client($mongoUri);

    echo "Connexion à MongoDB réussie.<br>";

    // Liste des bases de données disponibles
    $databases = $client->listDatabases();
    echo "Bases de données disponibles :<br>";
    foreach ($databases as $database) {
        echo "- " . $database['name'] . "<br>";
    }
} catch (\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}
