<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class StudentController extends BaseController {
    public function showHome() {
        
        $this->renderStudent('index');
    }

    public function showCourses() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 6; 
    
        $courseModel = new Course();
        $result = $courseModel->getAllCourses($page, $perPage);
    
        $this->renderStudent('courses', [
            'courses' => $result['courses'],
            'pagination' => $result['pagination']
        ]);
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
        $studentId = $_SESSION['user_id']; 
 
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5; 
 
        $courseModel = new Course();
        $result = $courseModel->getCoursesByStudent($studentId, $currentPage, $perPage);
 
        $this->renderStudent('myCourses', [
            'courses' => $result['courses'],
            'pagination' => $result['pagination']
        ]);
    }

    public function showCourseContent() {
        if (!isset($_SESSION['Logged_in'])) {
            header('Location: /login');
            exit;
        }
    
        $courseId = $_GET['course_id'] ?? null;
        if (!$courseId) {
            header('Location: /404'); 
            exit;
        }
    
        $courseModel = new Course();
        $course = $courseModel->getCourseDetails($courseId);
    
        if (!$course) {
            header('Location: /404'); 
            exit;
        }
    
        
        if (empty($course['content_url']) && empty($course['content_path'])) {
            echo 'this is null';die;
            exit;
        }
    
        $this->renderStudent('courseContent', ['course' => $course]);
    }
}