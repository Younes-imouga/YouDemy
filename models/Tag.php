<?php
require_once '../config/db.php';

class Tag extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllTags() {
        try {
            $sql = "SELECT * FROM tags ORDER BY name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createTag($name) {
        try {
            $sql = "INSERT INTO tags (name) VALUES (:name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateTag($id, $name) {
        try {
            $sql = "UPDATE tags SET name = :name WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteTag($id) {
        try {
            $sql = "DELETE FROM tags WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
} 