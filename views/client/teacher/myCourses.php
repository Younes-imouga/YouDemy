<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - My Courses</title>
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
        <a href="/my-courses" class="text-teal-600">My Courses</a>
        <a href="/login" class="text-gray-700 hover:text-teal-600">Login</a>
        <a href="/register" class="text-teal-600">Sign Up</a>
      </nav>
    </div>
  </header>

  <!-- My Courses Content -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">My Courses</h1>

    <!-- List of Courses -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800">Course Title 1</h2>
        <p class="text-gray-600 mt-2">Course Description</p>
        <a href="/course-details" class="mt-4 inline-block bg-teal-600 text-white px-4 py-2 rounded shadow hover:bg-teal-700">View Course</a>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800">Course Title 2</h2>
        <p class="text-gray-600 mt-2">Course Description</p>
        <a href="/course-details" class="mt-4 inline-block bg-teal-600 text-white px-4 py-2 rounded shadow hover:bg-teal-700">View Course</a>
      </div>
      <!-- More courses can be added here -->
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
