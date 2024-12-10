<?php
require '../vendor/autoload.php'; // Charge Composer

try {
    $client = new \MongoDB\Client("mongodb://localhost:27017");
    $db = $client->selectDatabase('arcadia');
    $collection = $db->selectCollection('schedules');

    $documents = $collection->find()->toArray();
    echo "<pre>";
    print_r($documents);
    echo "</pre>";
} catch (\Exception $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
}
