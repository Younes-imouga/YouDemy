<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Enrolled Courses</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

<?php include '../views/components/header.php'; ?>


  <!-- Enrolled Courses Section -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900">My Enrolled Courses</h1>
    <p class="text-lg text-gray-600 mt-2">Here are the courses you've enrolled in:</p>

    <!-- Courses List -->
    <div class="mt-6 space-y-4">
      <!-- Single Course -->
      <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-semibold text-gray-800">JavaScript for Beginners</h2>
          <p class="text-gray-600">Instructor: John Doe</p>
        </div>
        <button class="text-teal-600 hover:underline">Go to Course</button>
      </div>
      <!-- Single Course -->
      <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-semibold text-gray-800">HTML & CSS Mastery</h2>
          <p class="text-gray-600">Instructor: Jane Smith</p>
        </div>
        <button class="text-teal-600 hover:underline">Go to Course</button>
      </div>
      <!-- Repeat for additional courses -->
    </div>
  </main>

  <?php include '../views/components/footer.php'; ?>


</body>
</html>
