<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Lesson Content</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

<?php include '../views/components/header.php'; ?>

  <!-- Lesson Content Section -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900">Lesson: JavaScript Basics</h1>
    <p class="text-lg text-gray-600 mt-2">Instructor: John Doe</p>

    <!-- Video Section -->
    <div class="mt-8">
      <h2 class="text-2xl font-semibold text-gray-800">Lesson Video</h2>
      <div class="mt-4">
        <video controls class="w-full rounded-lg shadow">
          <source src="lesson-video.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>

    <!-- Text Content Section -->
    <div class="mt-8">
      <h2 class="text-2xl font-semibold text-gray-800">Lesson Details</h2>
      <p class="mt-4 text-gray-700 leading-7">
        In this lesson, you will learn the basics of JavaScript, including variables, data types, and basic programming concepts. JavaScript is one of the most widely used programming languages for creating dynamic and interactive web applications.
      </p>
    </div>

    <!-- Resources Section -->
    <div class="mt-8">
      <h2 class="text-2xl font-semibold text-gray-800">Additional Resources</h2>
      <ul class="mt-4 space-y-2">
        <li>
          <a href="lesson-slides.pdf" class="text-teal-600 hover:underline">Download Lesson Slides</a>
        </li>
        <li>
          <a href="practice-quiz.html" class="text-teal-600 hover:underline">Take the Practice Quiz</a>
        </li>
        <li>
          <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" class="text-teal-600 hover:underline">Learn More on MDN Web Docs</a>
        </li>
      </ul>
    </div>
  </main>

  <?php include '../views/components/footer.php'; ?>


</body>
</html>
