create database thoth;

use thoth

create table student (
    -> id int primary key auto_increment,
    -> name varchar(255),
    -> email varchar(255),
    -> password varchar(255)
    -> );

create table courses (
    -> id int primary key auto_increment,
    -> title varchar(255),
    -> description text
    -> );

create table enrollments (
    -> id int primary key auto_increment,
    -> enrollment_date timestamp default current_timestamp,
    -> student_id int,
    -> foreign key(student_id) references student(id),
    -> course_id int,
    -> foreign key(course_id) references courses(id)
    -> );