<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">


  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
    </div>
  </main>

    <?php include '../views/components/footer.php'; ?>
</body>
</html>
