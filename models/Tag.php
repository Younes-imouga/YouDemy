<?php
require_once '../config/db.php';

class Tag extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllTagsSelect() {
        try {
            $sql = "SELECT * FROM tags ORDER BY name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getAllTags($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        
        $countSql = "SELECT COUNT(*) FROM tags";
        $countStmt = $this->conn->prepare($countSql);
        $countStmt->execute();
        $totalCount = (int)$countStmt->fetchColumn();
        
        $sql = "SELECT * FROM tags ORDER BY name ASC LIMIT :offset, :per_page";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':per_page', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'tags' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'pagination' => [
                'currentPage' => (int)$page,
                'lastPage' => (int)ceil($totalCount / $perPage)
            ]
        ];
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