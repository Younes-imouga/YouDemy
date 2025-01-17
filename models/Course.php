<?php
require_once '../config/db.php';

class Course extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllCourses() {
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name,
                GROUP_CONCAT(t.name) as tag_names,
                GROUP_CONCAT(t.id) as tag_ids
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                LEFT JOIN course_tags ct ON c.id = ct.course_id
                LEFT JOIN tags t ON ct.tag_id = t.id
                GROUP BY c.id
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->processCourseTags($courses);
    }

    public function getCoursesByTeacher($teacherId) {
        $sql = "SELECT c.*, cat.name as category_name,
                GROUP_CONCAT(t.name) as tag_names,
                GROUP_CONCAT(t.id) as tag_ids
                FROM courses c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                LEFT JOIN course_tags ct ON c.id = ct.course_id
                LEFT JOIN tags t ON ct.tag_id = t.id
                WHERE c.teacher_id = :teacher_id 
                GROUP BY c.id
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->processCourseTags($courses);
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
            
            // Insert course
            $sql = "INSERT INTO courses (title, description, category_id, content_type, teacher_id) 
                    VALUES (:title, :description, :category_id, :content_type, :teacher_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'content_type' => $data['content_type'],
                'teacher_id' => $data['teacher_id']
            ]);

            $courseId = $this->conn->lastInsertId();

            // Insert course tags if present
            if (!empty($data['tags']) && is_array($data['tags'])) {
                $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
                $stmt = $this->conn->prepare($sql);
                
                foreach ($data['tags'] as $tagId) {
                    if (!empty($tagId)) {
                        $stmt->execute([
                            'course_id' => $courseId,
                            'tag_id' => $tagId
                        ]);
                    }
                }
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    private function getOrCreateTag($tagName) {
        
        $sql = "SELECT id FROM tags WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $tagName);
        $stmt->execute();
        
        if ($tag = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $tag['id'];
        }

        
        $sql = "INSERT INTO tags (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $tagName);
        $stmt->execute();
        
        return $this->conn->lastInsertId();
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
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name,
                GROUP_CONCAT(t.name) as tag_names,
                GROUP_CONCAT(t.id) as tag_ids,
                (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                LEFT JOIN course_tags ct ON c.id = ct.course_id
                LEFT JOIN tags t ON ct.tag_id = t.id
                WHERE c.id = :course_id
                GROUP BY c.id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['course_id' => $courseId]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$course) {
            return null;
        }
        
        // Process tags
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
        // Check if already enrolled
        $checkSql = "SELECT id FROM enrollments WHERE course_id = :course_id AND student_id = :student_id";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([
            'course_id' => $courseId,
            'student_id' => $studentId
        ]);
        
        if ($checkStmt->fetch()) {
            return ['success' => false, 'message' => 'You are already enrolled in this course'];
        }
        
        // Enroll the student
        $sql = "INSERT INTO enrollments (course_id, student_id, enrolled_at) 
                VALUES (:course_id, :student_id, NOW())";
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
} 