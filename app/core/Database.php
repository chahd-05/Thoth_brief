<?php

class Database {
    public static function connect(){
        try {
            $config = require_once __DIR__ . '/../../config/database.php';
            $db = new PDO(
                "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}", $config['user'], $config['password']);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die("error database: " . $e->getMessage());
        }
      
    }
}
?>