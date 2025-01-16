<?php
session_start();
include '../controllers/AdminController.php';
include '../controllers/StudentController.php';
include '../controllers/TeacherController.php';
include '../controllers/AuthController.php';
include '../core/Router.php';
include '../core/Route.php';

$router = new Router();
Route::setRouter($router);

if (!isset($_SESSION['Logged_in'])) { 
    Route::get("/", [AuthController::class, 'showHome']);
} else {
    if (isset($_SESSION['is_admin'])) {
        Route::get("/", [AdminController::class, 'showDashboard']);
    }else{
        if (isset($_SESSION['is_teacher'])) {
            Route::get("/", [TeacherController::class, 'showHome']);
        } else {
            Route::get("/", [StudentController::class, 'showHome']);
        }
    }
}

Route::get("/login", [AuthController::class, 'showLogin']);
Route::post("/login", [AuthController::class, 'Login']);

Route::get("/logout", [AuthController::class, 'logout']);

Route::get("/register", [AuthController::class, 'showRegister']);
Route::post("/register", [AuthController::class, 'Register']);

Route::get("/admin/dashboard", [AdminController::class, 'showDashboard']);
Route::get("/teacher/dashboard", [TeacherController::class, 'showDashboard']);
Route::get("/student/dashboard", [StudentController::class, 'showDashboard']);

Route::get("/tag", [AuthController::class, 'showtags']);
Route::post("/tag", [AuthController::class, 'showtags']);

Route::get("/my-courses", [StudentController::class, 'showMyCourses']);
Route::get("/courses", [StudentController::class, 'showCourses']);
Route::get("/profile", [StudentController::class, 'showProfile']);
Route::get("/profile/edit", [StudentController::class, 'showEditProfile']);
Route::get("/add-course", [TeacherController::class, 'showAddCourse']);
Route::get("/stats", [TeacherController::class, 'showStats']);
Route::get("/teacher/approval", [TeacherController::class, 'showApproval']);
Route::get("/privacy", [AuthController::class, 'showPrivacy']);
Route::get("/terms", [AuthController::class, 'showTerms']);
Route::get("/support", [AuthController::class, 'showSupport']);

Route::post("/admin/users", [AdminController::class, 'approveTeacher']);

Route::post("/admin/approve-teacher", [AdminController::class, 'approveTeacher']);
Route::post("/admin/reject-teacher", [AdminController::class, 'rejectTeacher']);

Route::get("/admin/teacher-approvals", [AdminController::class, 'showTeacherApprovals']);

Route::get("/admin/manage-users", [AdminController::class, 'showUsers']);
Route::get("/admin/manage-courses", [AdminController::class, 'showCourses']);

Route::get("/403", [BaseController::class, 'render403']);

// Route::get("path", [controller::class, 'method']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);