<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

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

            if ($user->login($email, $password)) {
                session_start();
                header('Location: /');
                exit;                
            } else {
                $this->renderView('auth/login');
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

            if ($user->register($name, $email, $password, $role)) {
                header('Location: /');
                exit;
            } else {
                $this->renderView('auth/register');
            }
        } else {
            $this->renderView('auth/register');
        }
    }
}