<?php
namespace App\Models;

use App\Config\MongoConnection;
use MongoDB\BSON\ObjectId;

class Schedule extends MongoConnection {
    private $collection;

    public function __construct() {
        parent::__construct();
        $this->collection = $this->getCollection('arcadia', 'schedules'); // Nom correct de la collection
    }

    public function getAllSchedules() {
        try {
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
            return $schedules;
        } catch (\Exception $e) {
            error_log('Erreur lors de la récupération des horaires : ' . $e->getMessage());
            return [];
        }
    }
}

