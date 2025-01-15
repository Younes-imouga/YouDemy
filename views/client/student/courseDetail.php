<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Course Details</title>
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

  <!-- Course Details Section -->
  <main class="flex-grow container mx-auto mt-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <!-- Course Title -->
      <h1 class="text-4xl font-bold text-gray-900">Introduction to JavaScript</h1>

      <!-- Course Metadata -->
      <div class="mt-4 text-gray-600 text-sm space-y-2">
        <p><strong>Instructor:</strong> John Doe</p>
        <p><strong>Category:</strong> Programming</p>
        <p><strong>Tags:</strong> JavaScript, Web Development</p>
        <p><strong>Duration:</strong> 10 hours</p>
      </div>

      <!-- Course Overview -->
      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800">Course Overview</h2>
        <p class="mt-2 text-gray-700">
          This course is designed to teach you the fundamentals of JavaScript, one of the most popular programming languages in web development. Learn how to write clean and efficient code, work with the DOM, and create interactive web applications.
        </p>
      </div>

      <!-- Course Content -->
      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800">What You'll Learn</h2>
        <ul class="mt-2 space-y-2 list-disc list-inside text-gray-700">
          <li>Variables, Data Types, and Operators</li>
          <li>Functions and Control Flow</li>
          <li>DOM Manipulation</li>
          <li>Events and Event Listeners</li>
          <li>ES6+ Features</li>
        </ul>
      </div>

      <!-- Enroll Button -->
      <div class="mt-6 flex justify-between items-center">
        <span class="text-lg font-bold text-teal-600">$49.99</span>
        <button class="bg-teal-600 text-white py-2 px-6 rounded-lg hover:bg-teal-700">
          Enroll Now
        </button>
      </div>
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
