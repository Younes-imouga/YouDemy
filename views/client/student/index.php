<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">


  <!-- Dashboard Content -->
  <main class="flex-grow container mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome, Student!</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <a href="/my-courses" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">My Courses</h2>
        <p class="text-gray-600 mt-2">View all the courses you are currently enrolled in.</p>
      </a>
      <a href="/courses" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">Explore Courses</h2>
        <p class="text-gray-600 mt-2">Browse and enroll in new courses.</p>
      </a>
      <a href="/profile" class="block bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-2xl font-bold text-teal-600">My Profile</h2>
        <p class="text-gray-600 mt-2">Edit your profile and manage your account settings.</p>
      </a>
    </div>
  </main>

  <!-- Footer -->
  <?php include '../views/components/footer.php'; ?>

</body>
</html>
