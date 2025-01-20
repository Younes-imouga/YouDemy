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
            
            $category = new Category();
            $categories = $category->getAllCategoriesSelect();
            
            
            $tag = new Tag();
            $tags = $tag->getAllTagsSelect();
            
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
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 5; 
        
        $course = new Course();
        $result = $course->getCoursesByTeacher($_SESSION['user_id'], $page, $perPage);
        
        
        error_log('Pagination data: ' . print_r($result['pagination'], true));
        
        $this->renderTeacher('myCourses', [
            'courses' => $result['courses'],
            'pagination' => $result['pagination']
        ]);
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
                
                
                $contentUrl = null;
                $contentPath = null;
                
                if ($contentType === 'video') {
                    $contentUrl = $_POST['video_url'] ?? '';
                    if (empty($contentUrl)) {
                        header('Location: /teacher/add-course?error=Video URL is required');
                        exit;
                    }
                } elseif ($contentType === 'document') {
                    if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
                        header('Location: /teacher/add-course?error=PDF file is required');
                        exit;
                    }
                    
                    $file = $_FILES['pdf_file'];
                    if ($file['size'] > 10 * 1024 * 1024) { 
                        header('Location: /teacher/add-course?error=File size must be less than 10MB');
                        exit;
                    }
                    
                    if ($file['type'] !== 'application/pdf') {
                        header('Location: /teacher/add-course?error=Only PDF files are allowed');
                        exit;
                    }
                    
                    $uploadDir = 'uploads/courses/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    $fileName = uniqid() . '_' . basename($file['name']);
                    $contentPath = $uploadDir . $fileName;
                    
                    if (!move_uploaded_file($file['tmp_name'], $contentPath)) {
                        header('Location: /teacher/add-course?error=Failed to upload file');
                        exit;
                    }
                }
                
                $course = new Course();
                $result = $course->createCourse([
                    'title' => $title,
                    'description' => $description,
                    'category_id' => $categoryId,
                    'content_type' => $contentType,
                    'content_url' => $contentUrl,
                    'content_path' => $contentPath,
                    'teacher_id' => $_SESSION['user_id'],
                    'tags' => $tags
                ]);
                
                if ($result) {
                    header('Location: /my-courses?success=Course created successfully');
                } else {

                    if ($contentPath && file_exists($contentPath)) {
                        unlink($contentPath);
                    }
                    header('Location: /teacher/add-course?error=Failed to create course');
                }
                exit;
            }
            
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

    public function showEnrollments() {
        $this->ensureTeacher();
        $studentId = $_SESSION['user_id'];
    
        $courseModel = new Course();
        $enrollments = $courseModel->getEnrollmentsByTeacher($studentId);
    
        $this->renderTeacher('enrollments', [
            'enrollments' => $enrollments
        ]);
    }

    public function acceptEnrollment() {
        $this->ensureTeacher();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $enrollmentId = $_POST['enrollment_id'];
            $courseModel = new Course();
            $courseModel->acceptEnrollment($enrollmentId);
            header('Location: /teacher/enrollments'); 
            exit;
        }
    }

    public function refuseEnrollment() {
        $this->ensureTeacher();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $enrollmentId = $_POST['enrollment_id'];
            $courseModel = new Course();
            $courseModel->refuseEnrollment($enrollmentId);
            header('Location: /teacher/enrollments'); 
            exit;
        }
    }

    public function deleteCourse() {
        $this->ensureTeacher(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courseId = $_POST['course_id'] ?? null;

            if ($courseId) {
                $courseModel = new Course();
                $courseModel->deleteCourse($courseId); 
                header('Location: /my-courses');
                exit;
            }
        }
        header('Location: /teacher/my-courses?error=Invalid course ID');
        exit;
    }
}