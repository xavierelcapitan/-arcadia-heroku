<?php
require '../vendor/autoload.php'; // Charge Composer

try {
    $mongoUri = getenv('MONGO_URI'); // Récupère l'URI depuis les variables d'environnement
    if (!$mongoUri) {
        throw new Exception('La variable d\'environnement MONGO_URI est introuvable.');
    }

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
