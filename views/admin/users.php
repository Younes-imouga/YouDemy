<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - User Management</title>
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
    <h1 class="text-3xl font-bold text-gray-800 mb-6">User Management</h1>

    <!-- User Table -->
    <div class="bg-white shadow rounded-lg p-4">
      <table class="min-w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100 text-gray-800">
            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">User Name</th>
            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Role</th>
            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Status</th>
            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 border border-gray-300 text-sm">John Doe</td>
            <td class="px-6 py-4 border border-gray-300 text-sm">Student</td>
            <td class="px-6 py-4 border border-gray-300 text-sm">Active</td>
            <td class="px-6 py-4 border border-gray-300 text-sm space-x-4">
              <button class="text-teal-600 hover:underline">Edit</button>
              <button class="text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
          <!-- Repeat for other users -->
        </tbody>
      </table>
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
