<?php
// src/Models/Review.php

namespace App\Models;

use PDO;

class Reviews extends Model
{
    public static function createReview($visitor_pseudo, $email, $comment)
    {
        $db = (new self())->getDbInstance();

        // Vérifie si un avis existe déjà pour cet email
        $stmt = $db->prepare("SELECT id FROM reviews WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; // Un avis existe déjà pour cet email
        }

        // Insère le nouvel avis
        $stmt = $db->prepare("INSERT INTO reviews (visitor_pseudo, email, comment) VALUES (:visitor_pseudo, :email, :comment)");
        $stmt->bindParam(':visitor_pseudo', $visitor_pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);
        return $stmt->execute();
    }

    public static function getPendingReviews()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT * FROM reviews WHERE status = 'pending' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    public static function approveReview($id)
    {
        $db = (new self())->getDbInstance();
        
        // Récupère l'email du visiteur pour envoyer une notification
        $stmt = $db->prepare("SELECT email FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $review = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($review) {
            // Valide l'avis
            $stmt = $db->prepare("UPDATE reviews SET status = 'approved' WHERE id = :id"); // Remplace TRUE par 'approved'
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();
    
            if ($success) {
                self::sendApprovalEmail($review->email);
            }
            return $success;
        }
        return false;
    }
    

    private static function sendApprovalEmail($email)
    {
        // Envoie un email de notification au visiteur
        $subject = "Votre avis a été approuvé !";
        $message = "Bonjour,\n\nVotre avis a été validé et est maintenant visible sur notre site.\n\nMerci de votre contribution !";
        $headers = "From: noreply@arcadia.com"; // Remplace avec l'email de ton choix

        mail($email, $subject, $message, $headers);
    }

    public static function getApprovedReviews()
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->query("SELECT * FROM reviews WHERE status = 'approved'");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    

    public static function rejectReview($id)
{
    $db = (new self())->getDbInstance();
    $stmt = $db->prepare("UPDATE reviews SET status = 'rejected' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public static function getRejectedReviews()
{
    $db = (new self())->getDbInstance();
    $stmt = $db->query("SELECT * FROM reviews WHERE status = 'rejected' ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public static function getCount()
{
    $db = (new self())->getDbInstance();
    $stmt = $db->query("SELECT COUNT(*) AS count FROM reviews");
    return $stmt->fetch(PDO::FETCH_OBJ)->count;
}

}

