<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-br from-gray-100 to-gray-150 text-gray-800 font-sans">

  
  <main class="flex-grow container mx-auto mt-[150px]">
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

    <section class="mt-[110px] grid grid-cols-1 md:grid-cols-3 gap-8 w-full mx-auto">
      <div class="bg-white rounded-lg shadow p-6 text-center ml-auto mr-10">
        <svg class="mx-auto w-12 h-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14.5l-3-3h6l-3 3zm-1-9h2v6h-2z" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mt-4">Learn Anytime, Anywhere</h3>
        <p class="text-gray-600 mt-2">Access courses from any device at your convenience.</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <svg class="mx-auto w-12 h-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4l12 8-12 8V4zm8 14h6m-6-6h6m-6-6h6" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mt-4">Wide Range of Courses</h3>
        <p class="text-gray-600 mt-2">Choose from a variety of subjects and skills to learn.</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <svg class="mx-auto w-12 h-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4a8 8 0 110 16 8 8 0 010-16zm0 4a4 4 0 100 8 4 4 0 000-8zm2 6H10m1 0v2m1-2v-2" />
        </svg>
        <h3 class="text-lg font-semibold text-gray-900 mt-4">Expert Instructors</h3>
        <p class="text-gray-600 mt-2">Learn from industry professionals and experienced educators.</p>
      </div>
    </section>


  </main>

  <?php include '../views/components/footer.php'; ?>

</body>
</html>
