<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">

  <!-- Navbar -->
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

  <!-- Main Content -->
  <main class="container mx-auto flex-grow mt-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">Available Courses</h1>

    <!-- Grid Structure -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- Course Card -->

      
      <!-- Duplicate Course Card for Multiple Courses -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <img src="https://via.placeholder.com/400x250" alt="Course Image" class="w-full h-48 object-cover rounded-md">
        <h2 class="mt-4 text-2xl font-bold text-gray-900">Another Course</h2>
        <h3 class="mt-4 text-xl font-bold text-gray-900">teacher</h2>
        <p class="mt-2 text-gray-600">This course is perfect for anyone looking to expand their knowledge on [topic].</p>
        <div class="mt-4 flex justify-between items-center">
          <p class="text-teal-600 font-bold">$29.99</p>
          <a href="/course-details" class="text-white bg-teal-600 px-4 py-2 rounded hover:bg-teal-700">View</a>
        </div>
      </div>

      <!-- Add more cards as needed -->
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
