<?php
require_once __DIR__ . '/../core/Database.php';

class Course {

    private $db;

    public function __construct(){

    $this->db = Database::getConnection();
    }

    public function getAll(){
        $stmt = $this->db->prepare("select * from courses");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare("select * from courses where id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
