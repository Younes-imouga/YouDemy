<?php
require_once '../core/BaseController.php';
require_once '../models/User.php';
require_once '../models/Teacher.php';

class AuthController extends BaseController {
    public function showLogin() {
        $this->renderView('auth/login');
    }

    public function showRegister() {
        $this->renderView('auth/register');
    }

    public function login() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $userData = $user->login($email, $password);

            if ($userData) {
                session_start();
                $_SESSION['Logged_in'] = true;
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['name'];
                $_SESSION['email'] = $userData['email'];
                
                if ($userData['role'] === 'admin') {
                    $_SESSION['is_admin'] = true;
                    header('Location: /admin/dashboard');
                } elseif ($userData['role'] === 'teacher') {
                    $_SESSION['is_teacher'] = true;
                    $teacher = new Teacher();
                    $status = $teacher->checkTeacherStatus($email);
                    
                    if ($status === 'pending') {
                        header('Location: /teacher/approval');
                    } else {
                        header('Location: /teacher/dashboard');
                    }
                } else {
                    header('Location: /student/dashboard');
                }
                exit;
            } else {
                $this->renderView('auth/login', ['error' => 'Invalid credentials']);
            }
        } else {
            $this->renderView('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $user = new User();
            $first = $user->isFirstUser();
            if ($first) {
                $role = 'admin';
            }

            if ($role === 'teacher') {
                $teacher = new Teacher();
                $result = $teacher->register($name, $email, $password, $role);
            } else {
                $result = $user->register($name, $email, $password, $role);
            }
            
            if ($result['success']) {
                $userData = $user->login($email, $password);
                
                if ($userData) {
                    session_start();
                    $_SESSION['Logged_in'] = true;
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['username'] = $userData['name'];
                    $_SESSION['email'] = $userData['email'];
                    
                    if ($userData['role'] === 'admin') {
                        $_SESSION['is_admin'] = true;
                        header('Location: /admin/dashboard');
                    } elseif ($userData['role'] === 'teacher') {
                        $_SESSION['is_teacher'] = true;
                        $teacher = new Teacher();
                        $status = $teacher->checkTeacherStatus($email);
                        
                        if ($status === 'pending') {
                            header('Location: /teacher/approval');
                        } else {
                            header('Location: /teacher/dashboard');
                        }
                    } else {
                        header('Location: /student/dashboard');
                    }
                    exit;
                }
            } else {
                $this->renderView('auth/register', ['error' => $result['message']]);
                return;
            }
            
            $this->renderView('auth/register', ['error' => 'Registration failed']);
        } else {
            $this->renderView('auth/register');
        }
    }
    public function showHome() {
        $this->renderView('client/index');
    }

    public function showPrivacy() {
        $this->renderView('privacy');
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function showTerms() {
        $this->renderView('terms');
    }

    public function showSupport() {
        $this->renderView('support');
    }
}