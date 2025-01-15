<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class AdminController extends BaseController {
    public function showDashboard() {
        $this->renderAdmin('dashboard');
    }
}