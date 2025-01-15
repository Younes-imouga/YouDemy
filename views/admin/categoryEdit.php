<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Edit Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="#" class="text-2xl font-bold text-teal-600">Youdemy</a>
      <nav class="space-x-4">
        <a href="/" class="text-gray-700 hover:text-teal-600">Home</a>
        <a href="/dashboard" class="text-gray-700 hover:text-teal-600">Dashboard</a>
        <a href="/logout" class="text-gray-700 hover:text-teal-600">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Content -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Category</h1>

    <!-- Form for Editing Category -->
    <form class="bg-white shadow rounded-lg p-8 w-1/2 mx-auto">
      <div class="mb-6">
        <label for="category-name" class="block text-sm font-medium text-gray-700">Category Name</label>
        <input type="text" id="category-name" class="w-full mt-2 p-3 border border-gray-300 rounded" placeholder="Enter Category Name" value="Programming">
      </div>
      <div class="mb-6">
        <label for="category-description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="category-description" class="w-full mt-2 p-3 border border-gray-300 rounded" rows="4" placeholder="Enter Description">Courses related to programming languages.</textarea>
      </div>
      <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded hover:bg-teal-700">Save Changes</button>
    </form>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white">
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
