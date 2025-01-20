<?php
require_once '../core/baseController.php';

class CourseController extends BaseController {
    public function showCourseDetail($id) {
        $course = new Course();
        $courseDetail = $course->getCourseWithDetails($id);
        $seeContent = false;    

        if (isset($_SESSION['is_admin'])) {
            $seeContent = true;
        } 

        elseif (isset($_SESSION['is_teacher'])) {
            if ($_SESSION['user_id'] === $courseDetail['teacher_id']) {
                $seeContent = true;
            }
        } 

        else {
            if (isset($_SESSION['is_student'])) {
                $studentId = $_SESSION['user_id'];
                $isEnrolled = $course->isUserEnrolled($id, $studentId);
                if ($isEnrolled) {
                    $seeContent = true;
                }
            }
        }

        if (!$courseDetail) {
            header('Location: /courses?error=Course not found');
            exit;
        }

        $this->renderStudent('courseDetail', [
            'course' => $courseDetail,
            'seeContent' => $seeContent
        ]);
    }

    public function enrollCourse() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login?error=Please login to enroll in courses');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /courses');
            exit;
        }

        $courseId = $_POST['course_id'] ?? null;
        if (!$courseId) {
            header('Location: /courses?error=Invalid course');
            exit;
        }

        $course = new Course();
        $result = $course->enrollStudent($courseId, $_SESSION['user_id']);

        if ($result['success']) {
            header("Location: /student/my-courses");
            exit;
        } else {
            header('Location: /course/' . $courseId . '?error=' . urlencode($result['message']));
        }
        exit;
    }
} 