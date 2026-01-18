<?php

require_once __DIR__ . '/../core/Database.php';

class Student {

    public $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function create($name, $email, $password){
        $sql = "insert into student (name, email, password) values (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $email, $password]);
    }

    public function findByEmail($email){
        $sql = "select * from student where email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id){
        $sql = "select * from student where id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
