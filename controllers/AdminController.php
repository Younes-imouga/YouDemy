<?php
require_once '../models/User.php';
require_once '../models/Admin.php';
require_once '../models/course.php';
require_once '../models/category.php';
require_once '../models/Tag.php';
require_once '../core/BaseController.php';

class AdminController extends BaseController {
    public function __construct() {
        $this->ensureAdmin();
    }
    
    public function showDashboard() {
        $this->renderAdmin('dashboard');
    }

    public function showTeacherApprovals() {
        $user = new Admin();
        $pendingTeachers = $user->getPendingTeachers();
        $this->renderAdmin('teacherApprovals', ['pendingTeachers' => $pendingTeachers]);
    }

    public function approveTeacher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacher_id'])) {
            $teacherId = $_POST['teacher_id'];
            $user = new Admin();
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
            $user = new Admin();
            if ($user->deleteTeacher($teacherId)) {
                header('Location: /admin/teacher-approvals?success=Teacher rejected');
            } else {
                header('Location: /admin/teacher-approvals?error=Failed to reject teacher');
            }
        }
        exit;
    }

    public function showUsers() {
        $user = new Admin();
        $users = $user->getAllUsers();
        $this->renderAdmin('users', ['users' => $users]);
    }

    public function showCourses() {
        $course = new Course();
        $courses = $course->getAllCourses();
        $this->renderAdmin('courses', $courses);
    }

    public function showCategories() {
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $category = new Category();
        $result = $category->getAllCategories($page);
        
        $this->renderAdmin('category', [
            'categories' => $result['categories'],
            'pagination' => $result['pagination']
        ]);
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                header('Location: /admin/categories?error=Category name is required');
                exit;
            }

            $category = new Category();
            if ($category->createCategory($name, $description)) {
                header('Location: /admin/categories?success=Category added successfully');
            } else {
                header('Location: /admin/categories?error=Failed to add category');
            }
            exit;
        }
    }

    public function editCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($id) || empty($name)) {
                header('Location: /admin/categories?error=Category ID and name are required');
                exit;
            }

            $category = new Category();
            if ($category->updateCategory($id, $name, $description)) {
                header('Location: /admin/categories?success=Category updated successfully');
            } else {
                header('Location: /admin/categories?error=Failed to update category');
            }
            exit;
        }
    }

    public function deleteCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';

            if (empty($id)) {
                header('Location: /admin/categories?error=Category ID is required');
                exit;
            }

            $category = new Category();
            if ($category->deleteCategory($id)) {
                header('Location: /admin/categories?success=Category deleted successfully');
            } else {
                header('Location: /admin/categories?error=Failed to delete category');
            }
            exit;
        }
    }

    public function showEditCategory($id) {
        $category = new Category();
        $categoryData = $category->getCategoryById($id);
        if (!$categoryData) {
            header('Location: /admin/categories?error=Category not found');
            exit;
        }
        $this->renderAdmin('categoryEdit', ['category' => $categoryData]);
    }

    public function showTags() {
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $tag = new Tag();
        $result = $tag->getAllTags($page);
        
        $this->renderAdmin('tags', [
            'tags' => $result['tags'],
            'pagination' => $result['pagination']
        ]);
    }

    public function addTag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tagsInput = $_POST['tags'] ?? '';
            
            if (empty($tagsInput)) {
                header('Location: /admin/tags?error=Tag name is required');
                exit;
            }

            $tagsArray = json_decode($tagsInput, true);

            if (!$tagsArray) {
                header('Location: /admin/tags?error=Invalid tag format');
                exit;
            }

            $tag = new Tag();
            $success = true;

            foreach ($tagsArray as $tagData) {
                if (!$tag->createTag($tagData['value'])) {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                header('Location: /admin/tags?success=Tags added successfully');
            } else {
                header('Location: /admin/tags?error=Failed to add some tags');
            }
            exit;
        }
    }

    public function deleteTag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';

            if (empty($id)) {
                header('Location: /admin/tags?error=Tag ID is required');
                exit;
            }

            $tag = new Tag();
            if ($tag->deleteTag($id)) {
                header('Location: /admin/tags?success=Tag deleted successfully');
            } else {
                header('Location: /admin/tags?error=Failed to delete tag');
            }
            exit;
        }
    }

    public function changeUserStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['action'])) {
            $userId = $_POST['user_id'];
            $action = $_POST['action'];
            $user = new Admin();

            switch ($action) {
                case 'activate':
                    $user->activateUser($userId);
                    header('Location: /admin/manage-users');
                    break;
                case 'deactivate':
                    $user->deactivateUser($userId);
                    header('Location: /admin/manage-users');
                    break;
                case 'suspend':
                    $user->suspendUser($userId);
                    header('Location: /admin/manage-users');
                    break;
                default:
                    header('Location: /admin/manage-users?error=Invalid action');
                    break;
            }
            exit;
        }
    }

    public function deleteCourse() {
        $this->ensureAdmin(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courseId = $_POST['course_id'] ?? null;

            if ($courseId) {
                $courseModel = new Course();
                $courseModel->deleteCourse($courseId); 
                header('Location: /admin/manage-courses');
                exit;
            }
        }
        header('Location: /admin/manage-courses');
        exit;
    }

    public function showStatistics() {
        $this->renderAdmin('Statistics');
    }
}