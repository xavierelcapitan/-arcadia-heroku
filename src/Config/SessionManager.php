<?php 
// src/Config/SessionManager.php
namespace App\Config;

class SessionManager
{
    // Démarrer la session si elle n'est pas déjà démarrée
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Définir une variable de session
    public static function set($key, $value)
    {
        self::start(); // Démarrer la session si nécessaire
        $_SESSION[$key] = $value;
    }

    // Obtenir une variable de session
    public static function get($key)
    {
        self::start(); // Démarrer la session si nécessaire
        return $_SESSION[$key] ?? null; // Retourne null si la clé n'existe pas
    }

    // Vérifier si une variable de session existe
    public static function has($key)
    {
        self::start(); // Démarrer la session si nécessaire
        return isset($_SESSION[$key]);
    }

    // Supprimer une variable de session
    public static function remove($key)
    {
        self::start(); // Démarrer la session si nécessaire
        unset($_SESSION[$key]);
    }

    // Détruire la session (déconnexion)
    public static function destroy()
    {
        self::start(); // Démarrer la session si nécessaire
        session_destroy();
    }
}
