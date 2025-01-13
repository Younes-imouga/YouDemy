<?php
session_start();

$router = new Router();
Route::setRouter($router);

if (!isset($_SESSION['Logged_in'])) { 

} else {
    if (isset($_SESSION['is_admin'])) {

    }else{

    }
}



// Route::get("path", [controller::class, 'methode']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);