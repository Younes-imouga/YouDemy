<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['course']['title']); ?> - Course Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">

    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="/" class="text-2xl font-bold text-teal-600">Youdemy</a>
            <nav class="space-x-4">
                <a href="/" class="text-gray-700 hover:text-teal-600">Home</a>
                <a href="/dashboard" class="text-gray-700 hover:text-teal-600">Dashboard</a>
                <a href="/logout" class="text-gray-700 hover:text-red-600">Logout</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto flex-grow mt-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6"><?php echo htmlspecialchars($data['course']['title']); ?></h1>
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Instructor: <?php echo htmlspecialchars($data['course']['teacher_name']); ?></h3>
        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($data['course']['description']); ?></p>

        <?php
        $isAdmin = isset($_SESSION['is_admin']);
        $isTeacher = isset($_SESSION['is_teacher']) && $_SESSION['user_id'] === $data['course']['teacher_id'];
        $isEnrolled = in_array($_SESSION['user_id'], array_column($data['enrolled_students'], 'id'));
        ?>

        <?php if ($isAdmin || $isTeacher || $isEnrolled): ?>
            <a href="/student/courseContent?course_id=<?php echo $data['course']['id']; ?>" class="text-white bg-teal-600 px-4 py-2 rounded hover:bg-teal-700">View Content</a>
        <?php else: ?>
            <form action="/enroll" method="POST">
                <input type="hidden" name="course_id" value="<?php echo $data['course']['id']; ?>">
                <button type="submit" class="text-white bg-teal-600 px-4 py-2 rounded hover:bg-teal-700">Enroll</button>
            </form>
        <?php endif; ?>
    </main>

    <?php include '../views/components/footer.php'; ?>

</body>
</html>