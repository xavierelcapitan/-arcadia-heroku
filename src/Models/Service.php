<?php
// Models/Service.php

namespace App\Models;
use App\Models\Model;
use PDO;

class Service extends Model
{
    protected static $table = 'services';

    public static function getAll()
    {
        $db = self::getDbInstance();
        $stmt = $db->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById($id)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function create($data)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("INSERT INTO services (name, description, location, image_path, opening_time, closing_time, child_price, adult_price, group_price, is_free, created_at) VALUES (:name, :description, :location, :image_path, :opening_time, :closing_time, :child_price, :adult_price, :group_price, :is_free, :created_at)");
        return $stmt->execute($data);
    }

    public static function update($id, $data)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("UPDATE services SET name = :name, description = :description, location = :location, image_path = :image_path, opening_time = :opening_time, closing_time = :closing_time, child_price = :child_price, adult_price = :adult_price, group_price = :group_price, is_free = :is_free WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public static function delete($id)
    {
        $db = self::getDbInstance();
        $stmt = $db->prepare("DELETE FROM services WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    
}
