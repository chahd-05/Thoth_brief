<?php

class Database {
    public static function getConnection(){

    $config = require __DIR__ . '/../../config/database.php';

        try {
            
            $db = new PDO(
                "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}", $config['user'], $config['password']);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
        }
        catch(PDOException $e){
            die("error database: " . $e->getMessage());
        }
      
    }
}
?>