<?php
require_once '../config/db.php';

class Course extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllCourses($page = 1, $perPage = 6) {
        $offset = ($page - 1) * $perPage;
    
        $countSql = "SELECT COUNT(*) FROM courses";
        $countStmt = $this->conn->prepare($countSql);
        $countStmt->execute();
        $totalCount = (int)$countStmt->fetchColumn();
    
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name FROM courses c JOIN users u ON c.teacher_id = u.id LEFT JOIN categories cat ON c.category_id = cat.id ORDER BY c.created_at DESC LIMIT :offset, :perPage";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $pagination = [
            'total' => $totalCount,
            'currentPage' => $page,
            'perPage' => $perPage,
            'lastPage' => (int)ceil($totalCount / $perPage),
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $totalCount)
        ];
    
        return [
            'courses' => $courses,
            'pagination' => $pagination
        ];
    }

    public function getCoursesByTeacher($teacherId, $page = 1, $perPage = 5) {
        try {
            $offset = ($page - 1) * $perPage;
            
            
            $countSql = "SELECT COUNT(*) FROM courses WHERE teacher_id = :teacher_id";
            $countStmt = $this->conn->prepare($countSql);
            $countStmt->bindValue(':teacher_id', $teacherId, PDO::PARAM_INT);
            $countStmt->execute();
            $totalCount = (int)$countStmt->fetchColumn();
            
            
            error_log("Total courses found: " . $totalCount);
            
            $sql = "SELECT c.*, cat.name as category_name, (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count, GROUP_CONCAT(DISTINCT t.name) as tag_names, GROUP_CONCAT(DISTINCT t.id) as tag_ids FROM courses c  LEFT JOIN categories cat ON c.category_id = cat.id  LEFT JOIN course_tags ct ON c.id = ct.course_id LEFT JOIN tags t ON ct.tag_id = t.id WHERE c.teacher_id = :teacher_id  GROUP BY c.id ORDER BY c.created_at DESC LIMIT :offset, :per_page";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':teacher_id', $teacherId, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':per_page', $perPage, PDO::PARAM_INT);
            $stmt->execute();
            
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $courses = $this->processCourseTags($courses);
            
            $pagination = [
                'total' => $totalCount,
                'currentPage' => (int)$page,
                'perPage' => (int)$perPage,
                'lastPage' => (int)ceil($totalCount / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $totalCount)
            ];
            
            
            error_log("Pagination data: " . print_r($pagination, true));
            
            return [
                'courses' => $courses,
                'pagination' => $pagination
            ];
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [
                'courses' => [],
                'pagination' => [
                    'total' => 0,
                    'currentPage' => 1,
                    'perPage' => $perPage,
                    'lastPage' => 1,
                    'from' => 0,
                    'to' => 0
                ]
            ];
        }
    }

    private function processCourseTags($courses) {
        foreach ($courses as &$course) {
            $course['tags'] = [];
            if (!empty($course['tag_names']) && !empty($course['tag_ids'])) {
                $names = explode(',', $course['tag_names']);
                $ids = explode(',', $course['tag_ids']);
                foreach ($names as $index => $name) {
                    $course['tags'][] = [
                        'id' => $ids[$index],
                        'name' => trim($name)
                    ];
                }
            }
        }
        return $courses;
    }

    public function createCourse($data) {
        try {
            $this->conn->beginTransaction();
    
            $content = null;
    
            if ($data['content_type'] === 'video') {
                $content = new VideoContent($data['content_url']);
            } elseif ($data['content_type'] === 'document') {
                $content = new DocumentContent($data['content_path']);
            }
    
            $sql = "INSERT INTO courses (title, description, category_id, content_type, content_url, content_path, teacher_id) VALUES (:title, :description, :category_id, :content_type, :content_url, :content_path, :teacher_id)";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'content_type' => $data['content_type'],
                'content_url' => $content ? $content->getContent() : null,
                'content_path' => $content ? $content->getContent() : null,
                'teacher_id' => $data['teacher_id']
            ]);
    
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function addCourseTags($courseId, $tagIds) {
        try {
            
            $checkSql = "SELECT tag_id FROM course_tags WHERE course_id = :course_id AND tag_id = :tag_id";
            $checkStmt = $this->conn->prepare($checkSql);
            
            $insertSql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $insertStmt = $this->conn->prepare($insertSql);
            
            foreach ($tagIds as $tagId) {
                
                $checkStmt->execute([
                    'course_id' => $courseId,
                    'tag_id' => $tagId
                ]);
                
                
                if (!$checkStmt->fetch()) {
                    $insertStmt->execute([
                        'course_id' => $courseId,
                        'tag_id' => $tagId
                    ]);
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCourseTags($courseId) {
        $sql = "SELECT t.* FROM tags t 
                JOIN course_tags ct ON t.id = ct.tag_id 
                WHERE ct.course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseWithDetails($courseId) {
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name, GROUP_CONCAT(t.name) as tag_names, GROUP_CONCAT(t.id) as tag_ids, (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count FROM courses c  JOIN users u ON c.teacher_id = u.id  LEFT JOIN categories cat ON c.category_id = cat.id  LEFT JOIN course_tags ct ON c.id = ct.course_id LEFT JOIN tags t ON ct.tag_id = t.id WHERE c.id = :course_id GROUP BY c.id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $courseId]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$course) {
            return null;
        }
        
        
        $course['tags'] = [];
        if (!empty($course['tag_names']) && !empty($course['tag_ids'])) {
            $names = explode(',', $course['tag_names']);
            $ids = explode(',', $course['tag_ids']);
            foreach ($names as $index => $name) {
                $course['tags'][] = [
                    'id' => $ids[$index],
                    'name' => trim($name)
                ];
            }
        }
        
        return $course;
    }

    public function enrollStudent($courseId, $studentId) {
        
        $checkSql = "SELECT id FROM enrollments WHERE course_id = :course_id AND student_id = :student_id";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([
            'course_id' => $courseId,
            'student_id' => $studentId
        ]);
        
        if ($checkStmt->fetch()) {
            return ['success' => false, 'message' => 'You are already enrolled in this course waiting for approval'];   
        }
        
        
        $sql = "INSERT INTO enrollments (course_id, student_id, status) VALUES (:course_id, :student_id, 'pending')";
        $stmt = $this->conn->prepare($sql);
        
        try {
            $stmt->execute([
                'course_id' => $courseId,
                'student_id' => $studentId
            ]);
            return ['success' => true, 'message' => 'Successfully enrolled in the course'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Failed to enroll in the course'];
        }
    }

    public function getCoursesByStudent($studentId, $currentPage, $perPage) {
        $offset = ($currentPage - 1) * $perPage;

        $countStmt = $this->conn->prepare("SELECT COUNT(*) FROM enrollments WHERE student_id = :student_id AND status = 'active'");
        $countStmt->bindParam(':student_id', $studentId);
        $countStmt->execute();
        $totalCount = (int)$countStmt->fetchColumn();

        $stmt = $this->conn->prepare("SELECT c.*, u.username as teacher_name, cat.name as category_name FROM courses c JOIN enrollments e ON c.id = e.course_id JOIN users u ON c.teacher_id = u.id LEFT JOIN categories cat ON c.category_id = cat.id WHERE e.status = 'active' AND e.student_id = :student_id LIMIT :offset, :perPage");
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pagination = [
            'total' => $totalCount,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'lastPage' => (int)ceil($totalCount / $perPage),
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $totalCount)
        ];

        return [
            'courses' => $courses,
            'pagination' => $pagination
        ];
    }
    
    public function getCourseDetails($courseId) {
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name, (SELECT GROUP_CONCAT(s.id) FROM enrollments e JOIN users s ON e.student_id = s.id WHERE e.course_id = c.id) as enrolled_students FROM courses c JOIN users u ON c.teacher_id = u.id LEFT JOIN categories cat ON c.category_id = cat.id WHERE c.id = :course_id";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $courseId]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $course['enrolled_students'] = !empty($course['enrolled_students']) ? explode(',', $course['enrolled_students']) : [];
    
        return $course;
    }

    public function isUserEnrolled($courseId, $userId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM enrollments WHERE course_id = :course_id AND student_id = :user_id AND status = 'active'");
        $stmt->bindParam(':course_id', $courseId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }

    public function enrollInCourse($courseId, $studentId) {
        $sql = "INSERT INTO enrollments (course_id, student_id, status) VALUES (:course_id, :student_id, 'pending')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
        $stmt->bindValue(':student_id', $studentId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function showPendingEnrollments() {
        $teacherId = $_SESSION['user_id'];
        $sql = "SELECT e.id, c.title, u.username 
                FROM enrollments e 
                JOIN courses c ON e.course_id = c.id 
                JOIN users u ON e.student_id = u.id 
                WHERE c.teacher_id = :teacher_id AND e.status = 'pending'";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacherId, PDO::PARAM_INT);
        $stmt->execute();
        $pendingEnrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pendingEnrollments;
    }

    public function getEnrollmentsByTeacher($teacherId) {
        $sql = "SELECT e.id, c.title, u.username AS student_name, e.status FROM enrollments e JOIN courses c ON e.course_id = c.id JOIN users u ON e.student_id = u.id WHERE c.teacher_id = :teacher_id AND e.status = 'pending'";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':teacher_id', $teacherId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptEnrollment($enrollmentId) {
        $sql = "UPDATE enrollments SET status = 'active' WHERE id = :enrollment_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':enrollment_id', $enrollmentId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function refuseEnrollment($enrollmentId) {
        $sql = "DELETE FROM enrollments WHERE id = :enrollment_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':enrollment_id', $enrollmentId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteCourse($courseId) {
        $sql = "DELETE FROM courses WHERE id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
        $stmt->execute();
    }
} 