<?php
// src/Services/EmailService.php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    public static function sendAccountCreationEmail($email, $firstName)
    {
        $mail = new PHPMailer(true);
        $siteUrl = 'https://url_site.com'; 
        $name = $firstName; 
        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-elcapitanstudi.alwaysdata.net'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'elcapitanstudi@alwaysdata.net';
            $mail->Password = 'Wx6eLfg^c7QBT&RSMkjs';
           // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 587;

               // Debug SMTP
               $mail->SMTPDebug = 3; // Niveau de débogage
               $mail->Debugoutput = function($str, $level) { error_log("SMTP debug level $level; message: $str"); };
   

            // Paramètres de l’e-mail
            $mail->setFrom('elcapitanstudi@alwaysdata.net', 'Admin');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Votre compte a été créé';


            
            // Contenu de l’e-mail
            $mail->Body = "
                <h1>Bienvenue, $name !</h1>
                <p>Votre compte a été créé avec succès sur notre site.</p>
                <p>Identifiant : $email</p>
                <p>Merci de vous rapprocher de l'administrateur pour votre mot de passe.</p>
                <p>URL du site : <a href='$siteUrl'>$siteUrl</a></p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'email : " . $e->getMessage());
            error_log("Erreur PHPMailer : " . $mail->ErrorInfo);
            return false;
        }
    }
}
