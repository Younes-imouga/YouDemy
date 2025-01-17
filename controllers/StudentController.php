<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class StudentController extends BaseController {
    public function showHome() {
        // Public page - no verification needed
        $this->renderStudent('index');
    }

    public function showCourses() {
        $course = new Course();
        $courses = $course->getAllCourses();
        $this->renderStudent('courses', ['courses' => $courses]);
    }

    public function showDashboard() {
        $this->ensureStudent();
        $this->renderStudent('index');
    }

    public function showProfile() {
        $this->ensureStudent();
        $this->renderStudent('profile');
    }

    public function showEditProfile() {
        $this->ensureStudent();
        $this->renderStudent('editProfile');
    }

    public function showMyCourses() {
        $this->ensureStudent();
        $this->renderStudent('myCourses');
    }
}