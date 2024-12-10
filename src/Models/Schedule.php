<?php
// src/Models/Schedule.php

namespace App\Models;

use App\Config\MongoDBConnection;
use MongoDB\Exception\Exception;
use Throwable;

class Schedule {
    private $collection;

    public function __construct() {
        $this->collection = (new MongoDBConnection())
            ->getConnection()
            ->selectDatabase('arcadia')
            ->selectCollection('schedules');
    }

    public function getAllSchedules() {
        try {
            $cursor = $this->collection->find();
            $schedules = [];
            foreach ($cursor as $document) {
                $schedules[] = [
                    'id' => (string) $document['_id'], // Convertir l'ObjectId en chaîne
                    'day' => $document['day'],
                    'opening_time' => $document['opening_time'],
                    'closing_time' => $document['closing_time'],
                    'is_closed' => $document['is_closed']
                ];
            }
            return $schedules;
        } catch (Throwable $e) {
            error_log('Erreur MongoDB : ' . $e->getMessage());
            return [];
        }
    }

    public function insertSchedule($data) {
        try {
            $this->collection->insertOne($data);
            return true;
        } catch (Throwable $e) {
            error_log('Erreur MongoDB : ' . $e->getMessage());
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
        } catch (Throwable $e) {
            error_log('Erreur MongoDB : ' . $e->getMessage());
            return false;
        }
    }

    public function deleteSchedule($id) {
        try {
            $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
            return true;
        } catch (Throwable $e) {
            error_log('Erreur MongoDB : ' . $e->getMessage());
            return false;
        }
    }
}
