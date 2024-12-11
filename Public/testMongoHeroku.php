<?php
require '../vendor/autoload.php';

try {
    // URI sans SRV
    $mongoUri = 'mongodb://xavbarcadia83:xavbarcadia83@cluster0.mongodb.net:27017,cluster0-shard-00-01.mongodb.net:27017,cluster0-shard-00-02.mongodb.net:27017/<database>?ssl=true&replicaSet=atlas-xxxxx-shard-0&authSource=admin&retryWrites=true&w=majority';

    $client = new MongoDB\Client($mongoUri);

    echo "Connexion à MongoDB réussie.<br>";

    $databases = $client->listDatabases();
    echo "Bases de données disponibles :<br>";
    foreach ($databases as $database) {
        echo "- " . $database['name'] . "<br>";
    }
} catch (\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}
