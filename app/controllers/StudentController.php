<?php
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Enrollment.php';
require_once __DIR__ . '/../models/Course.php';

class StudentController {

    private Student $studentModel;
    private Course $courseModel;

    public function __construct(){
        $this->studentModel = new Student();
        $this->courseModel = new Course();
    }

    public function register(){

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = trim ($_POST['name']);
        $email = trim ($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($name) || empty($email) || empty($password)){
            $error = "fill the fields required";
            require __DIR__ . '/../views/student/register.php';
            return;
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = 'invalid email';
            require __DIR__ . '/../views/student/register.php';
            return;
        }
        $exist = $this->studentModel->findByEmail($email);
        if ($exist){
            $error = 'email already exist';
            require __DIR__ . '/../views/student/register.php';
            return;
        }
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        $this->studentModel->create($name, $email, $hashedpassword);

        header('location: /Thoth_brief/public/student/login');
        exit();
        }

        require __DIR__ . '/../views/student/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $student = $this->studentModel->findByEmail($email);

        if (!$student || !password_verify($password, $student['password'])){
            $error = 'invalid credentials';
            require __DIR__ . "/../views/student/login.php";
            return;
        }
        $_SESSION['student_id'] = $student['id'];

        header('location: /thoth_brief/public/student/dashboard');
        exit();
        }

        require __DIR__ . '/../views/student/login.php';
    }

    public function logout(){
        session_destroy();
        header('location: /thoth_brief/public/student/login');
        exit();
    }
    public function dashboard(){

        Auth::check();

        $enrollment = new Enrollment();
        $course = $enrollment->getStudentCourse($_SESSION['student_id']);

        $student = $this->studentModel->findById($_SESSION['student_id']);
        $courses = $course;

        $allCourses = $this->courseModel->getAll();

        require_once __DIR__ . '/../views/student/dashboard.php';
    }

    public function enroll(){
        Auth::check();

        $course_id = $_POST['course_id'];
        $student_id = $_SESSION['student_id'];

        $enrollment = new Enrollment();
        $enrollment->enroll($student_id, $course_id);

        header('location: /thoth_brief/public/student/dashboard');
        exit();
    }

    public function unenroll(){
        Auth::check();

        $course_id = $_POST['course_id'];
        $student_id = $_SESSION['student_id'];

        $enrollment = new Enrollment();
        $enrollment->unenroll($student_id, $course_id);

        header('location: /thoth_brief/public/student/dashboard');
        exit();
    }
}
