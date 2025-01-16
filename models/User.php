<?php 
include '../config/db.php';

class User extends Db {
    public function __construct() {
        parent::__construct();
    }

    public function register($name, $email, $password, $role) {
        // Check if email or username already exists
        $sql = "SELECT * FROM users WHERE email = :email OR username = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user['email'] === $email) {
                return ['success' => false, 'message' => 'Email already exists'];
            }
            if ($user['username'] === $name) {
                return ['success' => false, 'message' => 'Username already exists'];
            }
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        
        if ($stmt->execute()) {
            return ['success' => true];
        }
        return ['success' => false, 'message' => 'Registration failed'];
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function isFirstUser() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM users");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
            return true;
        }
        return false;
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
}