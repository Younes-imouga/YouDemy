<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class TeacherController extends BaseController {
    public function showHome() {
        $this->renderTeacher('index');
    }


}