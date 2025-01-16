<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">


  <!-- Main Content -->
  <main class="flex-grow container mx-auto mt-8">
    <section class="text-center">
      <h1 class="text-4xl font-extrabold text-gray-900">Welcome to Youdemy</h1>
      <p class="text-lg text-gray-600 mt-4">
        Your personalized learning platform for students and teachers.
      </p>
      <a href="/register" class="mt-6 inline-block bg-teal-600 text-white px-6 py-2 rounded shadow hover:bg-teal-700">
        Get Started
      </a>
    </section>
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
