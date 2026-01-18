<?php
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Enrollment.php';
require_once __DIR__ . '/../core/Auth.php';

class Controller {

    private $courseModel;
    private $enrollmentModel;

    public function __construct(){
        $this->courseModel = new Course();
        $this->enrollmentModel = new Enrollment();
    }

    public function index(){
        Auth::check();

        $course = $this->courseModel->getAll();
        require_once __DIR__ . '/../models/Course.php';
    }

    public function enroll(){
        Auth::check();

        $course_id = $_POST['course_id'];
        $student_id = $_SESSION['student_id'];

        $this->enrollmentModel->enroll($student_id, $course_id);

        header('location: /thoth_brief/public/student/dashboard');
        exit();
    }
}