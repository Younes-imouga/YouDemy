<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class StudentController extends BaseController {
    public function showLogin() {
        $this->renderView('auth/login');
    }

    public function showRegister() {
        $this->renderView('auth/register');
    }


}