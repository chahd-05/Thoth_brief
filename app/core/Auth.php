<?php

class Auth {
    public static function check(){
        if (!isset($_SESSION['student_id'])){
            header ('location: /thoth_brief/public/student/login');
            exit();
        }
    }
    public static function student(){
        return $_SESSION['stuent_id'] ?? null;
    }
}