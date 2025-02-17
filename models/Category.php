<?php
require_once '../config/db.php';

class Category extends Db{

    public function __construct() {
        parent::__construct();
    }

    public function getAllCategoriesSelect(){
            try {
                $sql = "SELECT * FROM categories ORDER BY name";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }
    }

    public function getAllCategories($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        
        $countSql = "SELECT COUNT(*) FROM categories";
        $countStmt = $this->conn->prepare($countSql);
        $countStmt->execute();
        $totalCount = (int)$countStmt->fetchColumn();
        
        $sql = "SELECT * FROM categories ORDER BY name ASC LIMIT :offset, :per_page";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':per_page', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'categories' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'pagination' => [
                'currentPage' => (int)$page,
                'lastPage' => (int)ceil($totalCount / $perPage)
            ]
        ];
    }

    public function createCategory($name, $description) {
        try {
            $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateCategory($id, $name, $description) {
        try {
            $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCategoryById($id) {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
} 