<?php
session_start();
include '../controllers/AuthController.php';
include '../core/Router.php';
include '../core/Route.php';

$router = new Router();
Route::setRouter($router);

if (!isset($_SESSION['Logged_in'])) { 
    Route::get("/", [AuthController::class, 'showRegister']);
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



// Route::get("path", [controller::class, 'method']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);