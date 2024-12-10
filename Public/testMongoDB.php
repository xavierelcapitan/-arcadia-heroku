<?php
require '../vendor/autoload.php'; // Charge l'autoloader de Composer

try {
    // Remplacez par votre URI MongoDB si elle est différente
    $mongoUri = 'mongodb+srv://xavierelcapitan:mongoarcadia83@ecfxb.qvher.mongodb.net'; // URI par défaut pour MongoDB local
    $client = new MongoDB\Client($mongoUri);

    // Test de connexion
    echo "Connexion à MongoDB réussie.<br>";

    // Lister toutes les bases de données
    $databases = $client->listDatabases();
    echo "Bases de données disponibles :<br>";
    foreach ($databases as $database) {
        echo "- " . $database['name'] . "<br>";
    }
} catch (\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}
