<?php
require_once '../models/User.php';
require_once '../core/BaseController.php';

class TeacherController extends BaseController {
    private function checkTeacherStatus() {
        $teacher = new Teacher();
        $status = $teacher->checkTeacherStatus($_SESSION['email']);
        
        if ($status === 'pending') {
            header('Location: /teacher/approval');
            exit;
        }
        return $status === 'active';
    }

    public function showDashboard() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            $this->renderTeacher('index');
        }
    }

    public function showAddCourse() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            $this->renderTeacher('addCourse');
        }
    }

    public function showStats() {
        $this->ensureTeacher();
        if ($this->checkTeacherStatus()) {
            $this->renderTeacher('stats');
        }
    }

    public function showApproval() {
        $this->ensureTeacher();
        $teacher = new Teacher();
        $status = $teacher->checkTeacherStatus($_SESSION['email']);
        
        if ($status !== 'pending') {
            header('Location: /teacher/dashboard');
            exit;
        }
        $this->renderTeacher('approvement');
    }
}