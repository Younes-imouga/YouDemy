<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - Youdemy</title>
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
        <a href="/profile" class="text-teal-600">Profile</a>
        <a href="/login" class="text-gray-700 hover:text-teal-600">Login</a>
      </nav>
    </div>
  </header>

  <!-- Profile Content -->
  <section class="flex-grow container mx-auto mt-8">
    <div class="w-1/2 mx-auto bg-white p-8 rounded-lg shadow-lg">
      <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Your Profile</h1>
      
      <!-- Profile Info -->
      <div class="space-y-4">
        <div>
          <p class="font-semibold text-lg">Name:</p>
          <p class="text-gray-700">John Doe</p>
        </div>
        <div>
          <p class="font-semibold text-lg">Email:</p>
          <p class="text-gray-700">johndoe@example.com</p>
        </div>
        <div>
          <p class="font-semibold text-lg">Role:</p>
          <p class="text-gray-700">Student</p>
        </div>
      </div>
      
      <!-- Edit Profile Button -->
      <a href="/profile/edit" class="mt-6 inline-block bg-teal-600 text-white px-6 py-2 rounded shadow hover:bg-teal-700">
        Edit Profile
      </a>
    </div>
  </section>

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
