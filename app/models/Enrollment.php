<?php 
require_once __DIR__ . '/../core/Database.php';

class Enrollment {
    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }
    
    public function enroll($student_id, $course_id){
        $stmt = $this->db->prepare("
        insert into enrollments (student_id, course_id) values (?, ?)
        ");
        return $stmt->execute([$student_id, $course_id]);
    }

    public function unenroll($student_id, $course_id){
        $stmt = $this->db->prepare("
        delete from enrollments where student_id = ? and course_id = ?
        ");
        return $stmt->execute([$student_id, $course_id]);
    }

    public function getStudentCourse($student_id){
        $stmt = $this->db->prepare("
            select c.* from courses c join enrollments e on c.id = e.course_id where e.student_id = ?
        ");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}