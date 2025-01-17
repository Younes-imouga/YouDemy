<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class TeacherController extends BaseController {
    private function checkTeacherStatus() {
        $teacher = new Teacher();
        $status = strtolower($teacher->checkTeacherStatus($_SESSION['email']));
        
        switch($status) {
            case 'pending':
                header('Location: /teacher/approval');
                exit;
            case 'active':
                return true;
            case 'rejected':
                header('Location: /login?error=Your teacher account was rejected');
                exit;
            default:
                header('Location: /login?error=Invalid teacher status');
                exit;
        }
    }

    public function showDashboard() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {

            $this->renderTeacher('index');
        }
    }

    public function showAddCourse() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            // Get categories
            $category = new Category();
            $categories = $category->getAllCategories();
            
            // Get tags
            $tag = new Tag();
            $tags = $tag->getAllTags();
            
            $this->renderTeacher('addCourse', [
                'categories' => $categories,
                'tags' => $tags
            ]);
        }
    }

    public function showStats() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            $this->renderTeacher('stats');
        }
    }

    
    public function showMyCourses() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            $course = new Course();
            $courses = $course->getCoursesByTeacher($_SESSION['user_id']);
            $this->renderTeacher('myCourses', ['courses' => $courses]);
        }
    }

    public function showApproval() {
        $this->ensureTeacher();
        $teacher = new Teacher();
        $status = $teacher->checkTeacherStatus($_SESSION['email']);
        
        if ($status !== 'pending') {
            header('Location: /teacher/dashboard');
            exit;
        }
        $this->renderTeacher('approvement');
    }

    public function addCourse() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'] ?? '';
                $description = $_POST['description'] ?? '';
                $categoryId = $_POST['category_id'] ?? '';
                $contentType = $_POST['content_type'] ?? '';
                $tags = isset($_POST['tags']) ? (array)$_POST['tags'] : [];

                if (empty($title) || empty($description) || empty($categoryId) || empty($contentType)) {
                    header('Location: /teacher/add-course?error=All fields are required');
                    exit;
                }

                $course = new Course();
                $result = $course->createCourse([
                    'title' => $title,
                    'description' => $description,
                    'category_id' => $categoryId,
                    'content_type' => $contentType,
                    'teacher_id' => $_SESSION['user_id'],
                    'tags' => $tags
                ]);

                if ($result) {
                    header('Location: /my-courses?success=Course created successfully');
                } else {
                    header('Location: /teacher/add-course?error=Failed to create course');
                }
                exit;
            }

            // Get categories and tags for the form
            $category = new Category();
            $categories = $category->getAllCategories();
            
            $tag = new Tag();
            $tags = $tag->getAllTags();
            
            $this->renderTeacher('addCourse', [
                'categories' => $categories,
                'tags' => $tags
            ]);
        }
    }
}