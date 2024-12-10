<?php
// src/Models/HabitatReport.php

namespace App\Models;

use PDO;
use App\Config\Db;

class HabitatReport
{

   // Récupérer tous les rapports pour un habitat spécifique avec les infos utilisateur
   public static function getReportsByHabitatId($habitat_id)
   {
       $db = Db::getInstance();
       $stmt = $db->prepare("
           SELECT hr.*, u.first_name 
           FROM habitat_reports hr
           JOIN users u ON hr.user_id = u.id
           WHERE hr.habitat_id = :habitat_id
       ");
       $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourne tous les rapports avec les infos utilisateur
   }

    // Enregistrer un nouveau rapport vétérinaire
    public static function saveReport($data)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare("INSERT INTO habitat_reports (habitat_id, vet_opinion, improvements, user_id, created_at, updated_at) 
                              VALUES (:habitat_id, :vet_opinion, :improvements, :user_id, NOW(), NOW())");
        $stmt->bindParam(':habitat_id', $data['habitat_id'], PDO::PARAM_INT);
        $stmt->bindParam(':vet_opinion', $data['vet_opinion'], PDO::PARAM_STR);
        $stmt->bindParam(':improvements', $data['improvements'], PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT); // Ajout de user_id
        $stmt->execute();
    }
    
}
