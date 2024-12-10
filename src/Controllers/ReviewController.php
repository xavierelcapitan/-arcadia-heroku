<?php

// src/Controllers/MainController.php ou ReviewController.php

namespace App\Controllers;

use App\Models\Reviews;

class ReviewController
{
    public function submitReview()
    {
        $visitor_pseudo = $_POST['visitor_pseudo'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        
        if (Reviews::createReview($visitor_pseudo, $email, $comment)) {
            $_SESSION['success'] = "Votre avis a été soumis pour modération.";
        } else {
            $_SESSION['error'] = "Vous avez déjà soumis un avis avec cet email.";
        }
        header("Location: /"); // Redirige vers la page d'accueil
        exit();
    }

    public function moderation()
    {
        $pendingReviews = Reviews::getPendingReviews();
        $view = __DIR__ . '/../../Views/admin/reviews/moderation.php';
        $pageTitle = "Modération des Avis";
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }

    public function approveReview()
    {
        if (isset($_POST['review_id'])) {
            $reviewId = $_POST['review_id'];
            if (Reviews::approveReview($reviewId)) {
                $_SESSION['success'] = "L'avis a été approuvé.";
            } else {
                $_SESSION['error'] = "Impossible d'approuver l'avis. Veuillez réessayer.";
            }
        }
        header("Location: /index.php?controller=review&action=moderation");
        exit();
    }

    public function getApprovedReviews()
    {
        return Reviews::getApprovedReviews();
    }

    public function rejectReview()
{
    if (isset($_POST['review_id'])) {
        $reviewId = $_POST['review_id'];
        if (Reviews::rejectReview($reviewId)) {
            $_SESSION['success'] = "L'avis a été refusé.";
        } else {
            $_SESSION['error'] = "Impossible de refuser l'avis. Veuillez réessayer.";
        }
    }
    header("Location: /index.php?controller=review&action=moderation");
    exit();
}

}
