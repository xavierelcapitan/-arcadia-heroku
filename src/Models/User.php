<?php

namespace App\Models;

use PDO;

class User extends Model
{

    protected static $table = 'users';
    // Récupérer tous les utilisateurs
    public static function all()
    {
        $db = (new self())->getDbInstance(); // Appelle la méthode héritée de Model
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Récupérer un utilisateur par ID
    public static function find($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Supprimer un utilisateur
    public static function delete($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public static function emailExists($email)
{
    $db = self::getDbInstance();
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    return $stmt->fetchColumn() > 0;
}

 // Ajouter un utilisateur avec mot de passe haché en Argon2id
 public static function add($data)
 {
     $db = (new self())->getDbInstance();
     $stmt = $db->prepare('INSERT INTO users (email, password, first_name, last_name, role) VALUES (:email, :password, :first_name, :last_name, :role)');

 // Utilisation d'Argon2id pour hacher le mot de passe
 $hashedPassword = password_hash($data['password'], PASSWORD_ARGON2ID, [
    'memory_cost' => 1 << 17, // 128 MB
    'time_cost' => 4,         // 4 itérations
    'threads' => 2            // 2 threads
]);

     return $stmt->execute([
         ':email' => $data['email'],
         ':password' => password_hash($data['password'], PASSWORD_ARGON2ID), // Utilisation d'Argon2id
         ':first_name' => $data['first_name'],
         ':last_name' => $data['last_name'],
         ':role' => $data['role']
     ]);
 }

    // Mettre à jour un utilisateur
    public static function update($id, $data)
    {
        $db = (new self())->getDbInstance();
        
        // Préparer la requête de mise à jour
        $stmt = $db->prepare('UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name, role = :role WHERE id = :id');
        
        // Exécuter la requête avec les valeurs
        $result = $stmt->execute([
            ':id' => $id,
            ':email' => $data['email'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':role' => $data['role']
        ]);
    
        // Débogage : vérifier si la requête réussit ou échoue
        if (!$result) {
            var_dump($stmt->errorInfo()); // Afficher les erreurs SQL si la requête échoue
            die(); // Arrêter l'exécution pour voir le résultat
        }
    }

    // Méthode getById() (si nécessaire)
    public static function getById($id)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    // Méthode pour trouver un utilisateur par email
    public static function findByEmail($email)
    {
        $db = (new self())->getDbInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
