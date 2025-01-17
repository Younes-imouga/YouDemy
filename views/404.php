
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">
  
  <?php include '../views/components/header.php'; ?>
  <section class="flex-grow container mx-auto text-center mt-12">
    <h1 class="text-6xl font-extrabold text-gray-900 mb-4">404</h1>
    <p class="text-xl text-gray-600 mb-8">Oops! The page you are looking for doesn't exist.</p>
    <a href="/" class="text-teal-600 text-lg hover:text-teal-700">Go back to Home</a>
  </section>

  <?php include '../views/components/footer.php'; ?>


</body>
</html>
