<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="#" class="text-2xl font-bold text-teal-600">Youdemy</a>
      <nav class="space-x-4">
        <a href="/" class="text-gray-700 hover:text-teal-600">Home</a>
        <a href="/dashboard" class="text-teal-600">Dashboard</a>
        <a href="/logout" class="text-gray-700 hover:text-teal-600">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Content -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Placeholder cards for admin features -->
      <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold text-gray-900">Manage Users</h2>
        <p class="text-gray-600 mt-2">Activate, suspend, or delete users.</p>
        <a href="/manage-users" class="text-teal-600 mt-4 block hover:underline">Go to Users</a>
      </div>
      <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold text-gray-900">Manage Courses</h2>
        <p class="text-gray-600 mt-2">Add, edit, or remove courses.</p>
        <a href="/manage-courses" class="text-teal-600 mt-4 block hover:underline">Go to Courses</a>
      </div>
      <!-- Add more cards for other functionalities -->
    </div>
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
