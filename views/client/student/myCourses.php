<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Enrolled Courses</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="#" class="text-2xl font-bold text-teal-600">Youdemy</a>
      <nav class="space-x-4">
        <a href="/" class="text-gray-700 hover:text-teal-600">Home</a>
        <a href="/courses" class="text-gray-700 hover:text-teal-600">Courses</a>
        <a href="/login" class="text-gray-700 hover:text-teal-600">Login</a>
        <a href="/register" class="text-teal-600">Sign Up</a>
      </nav>
    </div>
  </header>

  <!-- Enrolled Courses Section -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900">My Enrolled Courses</h1>
    <p class="text-lg text-gray-600 mt-2">Here are the courses you've enrolled in:</p>

    <!-- Courses List -->
    <div class="mt-6 space-y-4">
      <!-- Single Course -->
      <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-semibold text-gray-800">JavaScript for Beginners</h2>
          <p class="text-gray-600">Instructor: John Doe</p>
        </div>
        <button class="text-teal-600 hover:underline">Go to Course</button>
      </div>
      <!-- Single Course -->
      <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-semibold text-gray-800">HTML & CSS Mastery</h2>
          <p class="text-gray-600">Instructor: Jane Smith</p>
        </div>
        <button class="text-teal-600 hover:underline">Go to Course</button>
      </div>
      <!-- Repeat for additional courses -->
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto text-center p-4">
      <p class="text-sm">© 2025 Youdemy - All Rights Reserved</p>
      <nav class="space-x-4 mt-2">
        <a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a>
        <a href="/terms" class="text-gray-400 hover:text-white">Terms of Service</a>
      </nav>
    </div>
  </footer>

</body>
</html>
