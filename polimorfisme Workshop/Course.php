<?php
class course {

    public $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($title, $description, $teacher_id, $category_id) {
        $sql = "INSERT INTO courses (title, description, teacher_id, category_id) VALUES (?, ?, ?, ?)";
        $params = [$title, $description, $teacher_id, $category_id];
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }
}