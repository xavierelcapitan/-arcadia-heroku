<?php
require '../vendor/autoload.php';

try {
    $mongoUri = getenv('MONGO_URI');
    if (!$mongoUri) {
        throw new Exception('La variable d\'environnement MONGO_URI est introuvable.');
    }

    // Ajoutez des options pour forcer l'utilisation de TLS 1.2
    $client = new MongoDB\Client($mongoUri, [], [
        'ssl' => true,
        'tlsInsecure' => false,
        'tlsAllowInvalidCertificates' => false,
        'tlsCAFile' => '/etc/ssl/certs/ca-certificates.crt', // Certificat CA par défaut sur la plupart des systèmes
    ]);

    echo "Connexion à MongoDB réussie.<br>";

    $databases = $client->listDatabases();
    echo "Bases de données disponibles :<br>";
    foreach ($databases as $database) {
        echo "- " . $database['name'] . "<br>";
    }
} catch (\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}
