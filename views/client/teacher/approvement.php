<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Waiting for Admin Approval</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

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

  <?php include '../views/components/footer.php'; ?>

</body>
</html>
