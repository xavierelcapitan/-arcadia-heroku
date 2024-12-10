<?php
require '../vendor/autoload.php'; // Charge l'autoloader de Composer

try {
    // Récupérez l'URI MongoDB depuis les variables d'environnement Heroku
    $mongoUri = getenv('MONGO_URI'); // Assurez-vous que MONGO_URI est configuré dans Heroku
    if (!$mongoUri) {
        throw new Exception('La variable d\'environnement MONGO_URI est introuvable.');
    }

    // Connexion au client MongoDB
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
    // Capture et affichage des erreurs
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}
