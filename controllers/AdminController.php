<?php
require_once '../models/User.php';
require_once '../models/course.php';
require_once '../core/BaseController.php';

class AdminController extends BaseController {
    public function __construct() {
        $this->ensureAdmin();
    }
    
    public function showDashboard() {
        // $user = new User();
        // // $pendingTeachers = $user->getPendingTeachers();
        $this->renderAdmin('dashboard');
    }

    public function showTeacherApprovals() {
        $user = new User();
        $pendingTeachers = $user->getPendingTeachers();
        $this->renderAdmin('teacherApprovals', ['pendingTeachers' => $pendingTeachers]);
    }

    public function approveTeacher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacher_id'])) {
            $teacherId = $_POST['teacher_id'];
            $user = new User();
            if ($user->approveTeacher($teacherId)) {
                header('Location: /admin/teacher-approvals?success=Teacher approved');
            } else {
                header('Location: /admin/teacher-approvals?error=Failed to approve teacher');
            }
        }
        exit;
    }

    public function rejectTeacher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacher_id'])) {
            $teacherId = $_POST['teacher_id'];
            $user = new User();
            if ($user->deleteTeacher($teacherId)) {
                header('Location: /admin/teacher-approvals?success=Teacher rejected');
            } else {
                header('Location: /admin/teacher-approvals?error=Failed to reject teacher');
            }
        }
        exit;
    }

    public function showUsers() {
        $user = new User();
        $users = $user->getAllUsers();
        $this->renderAdmin('users', ['users' => $users]);
    }

    public function showCourses() {
        $course = new Course();
        $courses = $course->getAllCourses();
        $this->renderAdmin('courses', ['courses' => $courses]);
    }
}