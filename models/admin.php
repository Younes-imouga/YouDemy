<?php 
require_once 'User.php';

class admin extends User {
    function __construct() {
        parent::__construct();
    }
    public function getAllUsers() {
        $sql = "SELECT id, username, email, role, status FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingTeachers() {
        $sql = "SELECT id, username, email FROM users WHERE role = 'teacher' AND status = 'pending'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveTeacher($id) {
        $sql = "UPDATE users SET status = 'active' WHERE id = :id AND role = 'teacher'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteTeacher($id) {
        $sql = "DELETE FROM users WHERE id = :id AND role = 'teacher'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function activateUser($userId) {
        $sql = "UPDATE users SET status = 'Active' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function deactivateUser($userId) {
        $sql = "UPDATE users SET status = 'Suspended' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function suspendUser($userId) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}
