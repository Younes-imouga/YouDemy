<?php 

class BaseController
{
    public function renderView($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }
    public function renderAdmin($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/admin/' . $view . '.php';
    }
    public function renderStudent($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/client/student/' . $view . '.php';
    }   
    public function renderTeacher($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/client/teacher/' . $view . '.php';
    }   
    public function render404()
    {
        http_response_code(404);
        include __DIR__ . '/../views/404.php';
        exit();
    }
    public function render403()
    {
        include __DIR__ . '/../views/403.php';
        exit();
    }

    public function showtags() {
        $this->renderView('auth/tags');
    }
    protected function ensureAdmin() {
        if (!isset($_SESSION['Logged_in']) || !isset($_SESSION['is_admin'])) {
            header('Location: /403');
            exit;
        }
    }
    protected function ensureTeacher() {
        if (!isset($_SESSION['Logged_in']) || !isset($_SESSION['is_teacher'])) {
            header('Location: /403');
            exit;
        }
    }
    protected function ensureStudent() {
        if (!isset($_SESSION['Logged_in']) || isset($_SESSION['is_teacher']) || isset($_SESSION['is_admin'])) {
            header('Location: /403');
            exit;
        }
    }
    protected function ensureAuth() {
        if (!isset($_SESSION['Logged_in'])) {
            header('Location: /login');
            exit;
        }
    }
    protected function allowVisitor() {
        // No restrictions - visitors allowed
        return true;
    }
}