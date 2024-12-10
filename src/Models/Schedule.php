<?php
namespace App\Models;

use App\Config\MongoDBConnection;
use MongoDB\Exception\Exception;

class Schedule {
    private $collection;

    public function __construct() {
        try {
            $this->collection = (new MongoDBConnection())
                ->getDatabase('arcadia') // Correction ici
                ->selectCollection('schedules');
        } catch (\Throwable $e) { // Gestion globale des erreurs
            error_log('Erreur lors de la connexion à MongoDB : ' . $e->getMessage());
            throw new \Exception('Connexion à MongoDB impossible.');
        }
    }

    public function getAllSchedules() {
        $cursor = $this->collection->find([], ['sort' => ['day' => 1]]);
        $schedules = [];
        foreach ($cursor as $document) {
            $schedules[] = [
                'id' => (string) $document['_id'],
                'day' => $document['day'],
                'opening_time' => $document['opening_time'],
                'closing_time' => $document['closing_time'],
                'is_closed' => $document['is_closed']
            ];
        }
        // Ajoutez un var_dump ici pour voir les données récupérées
        var_dump($schedules);
        return $schedules;
    }
    

    public function insertSchedule($data) {
        try {
            // Validation stricte des données
            if (!isset($data['day'], $data['opening_time'], $data['closing_time'], $data['is_closed'])) {
                throw new \Exception('Les données fournies sont incomplètes.');
            }
            $this->collection->insertOne($data);
            return true;
        } catch (\Throwable $e) {
            error_log('Erreur générale : ' . $e->getMessage());
            return false;
        }
    }

    public function updateSchedule($id, $data) {
        try {
            $this->collection->updateOne(
                ['_id' => new \MongoDB\BSON\ObjectId($id)],
                ['$set' => $data]
            );
            return true;
        } catch (\Throwable $e) {
            error_log('Erreur générale : ' . $e->getMessage());
            return false;
        }
    }

    public function deleteSchedule($id) {
        try {
            $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
            return true;
        } catch (\Throwable $e) {
            // Capturer toutes les erreurs et loguer leur type
            error_log('Erreur capturée : ' . get_class($e) . ' - ' . $e->getMessage());
            return false;
        }
    }
}
