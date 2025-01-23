<?php
session_start();
include '../controllers/AdminController.php';
include '../controllers/StudentController.php';
include '../controllers/TeacherController.php';
include '../controllers/CourseController.php';
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
            Route::get("/", [TeacherController::class, 'showDashboard']);
        } else {
            Route::get("/", [StudentController::class, 'showDashboard']);
        }
    }
}



        // public
        Route::get("/login", [AuthController::class, 'showLogin']);
        Route::post("/login", [AuthController::class, 'Login']);
        
        Route::get("/logout", [AuthController::class, 'logout']);
        
        Route::get("/register", [AuthController::class, 'showRegister']);
        Route::post("/register", [AuthController::class, 'Register']);
        
        
        Route::get("/tag", [AuthController::class, 'showtags']);
        Route::post("/tag", [AuthController::class, 'showtags']);

        Route::get('/course/([0-9]+)', ['CourseController', 'showCourseDetail']);

        // Admin
        Route::get("/admin/dashboard", [AdminController::class, 'showDashboard']);
        Route::post("/admin/users", [AdminController::class, 'approveTeacher']);

        Route::post("/admin/approve-teacher", [AdminController::class, 'approveTeacher']);
        Route::post("/admin/reject-teacher", [AdminController::class, 'rejectTeacher']);

        Route::get("/admin/teacher-approvals", [AdminController::class, 'showTeacherApprovals']);

        Route::get("/admin/manage-users", [AdminController::class, 'showUsers']);
        Route::post("/admin/change-user-status", [AdminController::class, 'changeUserStatus']);
        
        Route::get("/admin/manage-courses", [AdminController::class, 'showCourses']);

        Route::post('/admin/delete-course', [AdminController::class, 'deleteCourse']);


        Route::get("/admin/categories", [AdminController::class, 'showCategories']);
        Route::post("/admin/add-category", [AdminController::class, 'addCategory']);
        Route::post("/admin/edit-category", [AdminController::class, 'editCategory']);
        Route::get("/admin/edit-category/{id}", [AdminController::class, 'showEditCategory']);
        Route::post("/admin/delete-category", [AdminController::class, 'deleteCategory']);

        Route::get("/admin/tags", [AdminController::class, 'showTags']);
        Route::post("/admin/add-tag", [AdminController::class, 'addTag']);
        Route::post("/admin/delete-tag", [AdminController::class, 'deleteTag']);

        


        // Teacher

        Route::get("/teacher/dashboard", [TeacherController::class, 'showDashboard']);

        Route::get("/my-courses", [TeacherController::class, 'showMyCourses']);
        Route::get("/stats", [TeacherController::class, 'showStats']);
        Route::get("/teacher/approval", [TeacherController::class, 'showApproval']);
        
        Route::get("/add-course", [TeacherController::class, 'showAddCourse']);

        Route::get('/teacher/add-course', [TeacherController::class, 'showAddCourse']);
        Route::post('/teacher/add-course', [TeacherController::class, 'addCourse']);

        Route::post('/teacher/delete-course', [TeacherController::class, 'deleteCourse']);

        Route::get('/teacher/enrollments', [TeacherController::class, 'showEnrollments']);

        Route::post('/teacher/accept-enrollment', [TeacherController::class, 'acceptEnrollment']);
        Route::post('/teacher/refuse-enrollment', [TeacherController::class, 'refuseEnrollment']);

        // Student
        Route::get("/student/dashboard", [StudentController::class, 'showDashboard']);

        Route::get("/courses", [StudentController::class, 'showCourses']);
        Route::get("/student/my-courses", [StudentController::class, 'showMyCourses']);
        Route::get("/profile", [StudentController::class, 'showProfile']);
        Route::get("/profile/edit", [StudentController::class, 'showEditProfile']);

        Route::post("/enroll-course", [CourseController::class, 'enrollCourse']);

        Route::get("/student/courseContent", [StudentController::class, 'showCourseContent']);


Route::get("/403", [BaseController::class, 'render403']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);