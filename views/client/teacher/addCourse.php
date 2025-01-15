<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Add Course</title>
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

  <!-- Add Course Form -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">Add New Course</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
      <form>
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-semibold">Course Title</label>
          <input type="text" id="title" class="w-full p-3 border border-gray-300 rounded mt-2" placeholder="Enter course title" />
        </div>

        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-semibold">Course Description</label>
          <textarea id="description" class="w-full p-3 border border-gray-300 rounded mt-2" placeholder="Enter course description" rows="4"></textarea>
        </div>

        <div class="mb-4">
          <label for="content" class="block text-gray-700 font-semibold">Course Content (URL or File)</label>
          <input type="text" id="content" class="w-full p-3 border border-gray-300 rounded mt-2" placeholder="Enter course content URL or upload a file" />
        </div>

        <div class="mb-4">
          <label for="tags" class="block text-gray-700 font-semibold">Tags</label>
          <input type="text" id="tags" class="w-full p-3 border border-gray-300 rounded mt-2" placeholder="Enter tags, separated by commas" />
        </div>

        <div class="mb-4">
          <label for="category" class="block text-gray-700 font-semibold">Category</label>
          <select id="category" class="w-full p-3 border border-gray-300 rounded mt-2">
            <option value="">Select a category</option>
            <option value="programming">Programming</option>
            <option value="design">Design</option>
            <option value="business">Business</option>
            <!-- More categories can be added here -->
          </select>
        </div>

        <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded mt-4 hover:bg-teal-700">Add Course</button>
      </form>
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
