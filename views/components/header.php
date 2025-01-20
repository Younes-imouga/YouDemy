<?php
$navLinks = [];

if (!isset($_SESSION['Logged_in'])) {

    $navLinks = [
        ['href' => '/', 'text' => 'Home'],
        ['href' => '/courses', 'text' => 'Courses'],
        ['href' => '/login', 'text' => 'Login', 'class' => 'text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white'],
        ['href' => '/register', 'text' => 'Sign Up', 'class' => 'text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white']
    ];
} else {
    if (isset($_SESSION['is_admin'])) {
        
        $navLinks = [
            ['href' => '/admin/dashboard', 'text' => 'Dashboard'],
            ['href' => '/admin/manage-users', 'text' => 'Users'],
            ['href' => '/admin/teacher-approvals', 'text' => 'teachers'],
            ['href' => '/admin/categories', 'text' => 'categories'],
            ['href' => '/admin/tags', 'text' => 'tags'],
            ['href' => '/admin/manage-courses', 'text' => 'Courses'],
            ['href' => '/admin/statistics', 'text' => 'Statistics'],
            ['href' => '/logout', 'text' => 'Logout', 'class' => 'text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white']
        ];
    } elseif (isset($_SESSION['is_teacher'])) {
        
        $navLinks = [
            ['href' => '/teacher/dashboard', 'text' => 'Dashboard'],
            ['href' => '/my-courses', 'text' => 'My Courses'],
            ['href' => '/teacher/enrollments', 'text' => 'Pending Enrollments'],
            ['href' => '/add-course', 'text' => 'Add Course'],
            ['href' => '/logout', 'text' => 'Logout', 'class' => 'text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white']
        ];
    } else {
        
        $navLinks = [
            ['href' => '/', 'text' => 'Dashboard'],
            ['href' => '/courses', 'text' => 'Courses'],
            ['href' => '/student/my-courses', 'text' => 'My Courses'],
            ['href' => '/logout', 'text' => 'Logout', 'class' => 'text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white']
        ];
    }
}
?>

<header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a href="/" class="text-2xl font-bold text-teal-600">Youdemy</a>
        <nav class="space-x-4">
            <?php foreach ($navLinks as $link): ?>
                <a href="<?= $link['href'] ?>" 
                   class="<?= isset($link['class']) ? $link['class'] : 'text-gray-700 hover:text-teal-600' ?>">
                    <?= $link['text'] ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</header> 