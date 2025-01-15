<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Waiting for Admin Approval</title>
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

  <!-- Teacher Approval Waiting Section -->
  <main class="flex-grow container mx-auto mt-16">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-lg mx-auto">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">Waiting for Admin Approval</h1>
      <p class="text-lg text-gray-600 mb-6">
        You have successfully submitted your application to become a teacher on Youdemy. Your application is currently under review by the admin.
      </p>
      <p class="text-md text-gray-500 mb-6">
        Please be patient, and you will be notified once your account is approved.
      </p>
      <a href="/courses" class="mt-4 inline-block bg-teal-600 text-white px-6 py-2 rounded shadow hover:bg-teal-700">Go to Courses</a>
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
