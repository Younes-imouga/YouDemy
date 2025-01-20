<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <main class="flex-grow container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome, Teacher!</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
      <a href="/my-courses" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">My Courses</h2>
        <p class="text-gray-600 mt-2">Manage the courses you have created.</p>
      </a>
      <a href="/add-course" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">Add New Course</h2>
        <p class="text-gray-600 mt-2">Create and publish new courses for students.</p>
      </a>
      <a href="/teacher/enrollments" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">Pending Enrollments</h2>
        <p class="text-gray-600 mt-2">View and manage pending enrollments.</p>
      </a>
    </div>
  </main>
  <footer class="bg-gray-800 text-white">
    <div class="container mx-auto text-center p-4">
      <p class="text-sm">© 2025 Youdemy - All Rights Reserved</p>
    </div>
  </footer>

</body>
</html>
