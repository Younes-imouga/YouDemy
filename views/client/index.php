<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800 font-sans">

  
  <main class="flex-grow container mx-auto mt-16">
    <section class="text-center">
      <h1 class="text-5xl font-extrabold text-teal-700">
        Welcome to Youdemy
      </h1>
      <p class="text-lg text-gray-700 mt-4">
        Empowering personalized learning experiences for students and teachers alike.
      </p>
      <a href="/register" class="mt-6 inline-block bg-teal-600 text-white px-8 py-3 rounded-lg shadow-lg text-lg hover:bg-teal-700 transition duration-300">
        Get Started
      </a>
    </section>

    
    <section class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 w-full mx-auto">
      <div class="bg-white rounded-lg shadow p-6 text-center ml-auto mr-10">
        <svg class="mx-auto w-12 h-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75l10.5 10.5M12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mt-4">Search Courses</h3>
        <p class="text-gray-600 mt-2">Explore a wide range of subjects tailored to your interests.</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center mr-auto ml-10">
        <svg class="mx-auto w-12 h-12 text-teal-600" xmlns="http://www.w3.org/20/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75l10.5 10.5M12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mt-4">Certifications</h3>
        <p class="text-gray-600 mt-2">Earn certificates to showcase your skills and knowledge.</p>
      </div>

    </section>
  </main>

  <?php include '../views/components/footer.php'; ?>

</body>
</html>
