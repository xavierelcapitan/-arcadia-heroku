<?php
// src/Config/Autoloader.php

namespace App\Config;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        // Remplacer 'App\' par rien pour retrouver le chemin relatif sous 'src'
        $class = str_replace('App\\', '', $class);
        
        // Remplacer les backslashes par des slashes pour obtenir le chemin correct
        $class = str_replace('\\', '/', $class);

        // Générer le chemin complet vers le fichier de classe
        $file = __DIR__ . '/../' . $class . '.php';

        // Vérifier si le fichier existe et l'inclure
        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new \Exception("Le fichier pour la classe $class est introuvable à l'emplacement $file.");
        }
    }
}
