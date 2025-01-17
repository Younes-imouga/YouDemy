<?php 
require_once 'user.php';

class Teacher extends User {
    public function __construct() {
        parent::__construct();
    }   

    public function register($name, $email, $password, $role)
    {
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

        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role, status) VALUES (:name, :email, :password, :role, 'pending')");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        
        if ($stmt->execute()) {
            return ['success' => true];
        }
        return ['success' => false, 'message' => 'Registration failed'];
    }

    public function checkTeacherStatus($email) {
        $sql = "SELECT * FROM users WHERE email = :email AND role = 'teacher'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user['status'];
            exit;
        }
        return false;
    }
}