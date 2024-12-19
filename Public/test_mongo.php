<?php
require_once __DIR__ . '/../vendor/autoload.php';


use MongoDB\Client;

try {
    $uri = "mongodb://xavbarcadia83:xavarcadiaMDP@cluster0-shard-00-00.mongodb.net:27017,cluster0-shard-00-01.mongodb.net:27017,cluster0-shard-00-02.mongodb.net:27017/?replicaSet=atlas-abc123-shard-0&ssl=true&authSource=admin";
    $client = new Client($uri);
    $dbs = $client->listDatabases();

    echo "Connexion MongoDB réussie. Bases de données disponibles :<br>";
    foreach ($dbs as $db) {
        echo $db['name'] . "<br>";
    }
} catch (\Exception $e) {
    echo "Erreur MongoDB : " . $e->getMessage();
}
