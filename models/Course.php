<?php
require_once '../config/db.php';

class Course extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllCourses() {
        $sql = "SELECT c.*, u.username as teacher_name, cat.name as category_name 
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByTeacher($teacherId) {
        $sql = "SELECT c.*, cat.name as category_name 
                FROM courses c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE c.teacher_id = :teacher_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCourse($title, $description, $teacherId, $categoryId, $contentType) {
        $sql = "INSERT INTO courses (title, description, teacher_id, category_id, content_type, created_at) 
                VALUES (:title, :description, :teacher_id, :category_id, :content_type, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':content_type', $contentType);
        return $stmt->execute();
    }

    public function addCourseTags($courseId, $tagIds) {
        $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
        $stmt = $this->conn->prepare($sql);
        
        foreach ($tagIds as $tagId) {
            $stmt->bindParam(':course_id', $courseId);
            $stmt->bindParam(':tag_id', $tagId);
            $stmt->execute();
        }
        return true;
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
} 