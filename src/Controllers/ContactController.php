<?php
namespace App\Controllers;

class ContactController
{
    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $firstName = $_POST['first_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            // Validation des données (facultatif, à compléter si nécessaire)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die('Adresse email invalide.');
            }

            // Traitement des données (exemple d'enregistrement ou d'envoi d'email)
            // Vous pouvez enregistrer dans une base de données ou envoyer un email
            $to = "votreemail@example.com"; // Remplacez par votre adresse email
            $subject = "Nouveau message de $firstName via le formulaire de contact";
            $body = "Nom : $firstName\nEmail : $email\nMessage :\n$message";
            $headers = "From: $email";

            // Envoi d'email (facultatif)
            if (mail($to, $subject, $body, $headers)) {
                echo "Message envoyé avec succès.";
            } else {
                echo "Erreur lors de l'envoi du message.";
            }
        }
    }
}
