<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <section class="flex-grow container mx-auto mt-8">
    <div class="w-1/2 mx-auto bg-white p-8 rounded-lg shadow-lg">
      <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Your Profile</h1>
      
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
      
      <a href="/profile/edit" class="mt-6 inline-block bg-teal-600 text-white px-6 py-2 rounded shadow hover:bg-teal-700">
        Edit Profile
      </a>
    </div>
  </section>

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
