<?php
require_once("Database.php");
require_once("course.php");

$db = new Database();
$db->connect();

$course = new course($db);

$courseId = $course->create('title', 'description', 1, 1);

echo $courseId;