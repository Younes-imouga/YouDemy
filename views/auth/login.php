<?php include '../views/components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <!-- Login Content -->
  <section class="flex-grow container mx-auto mt-8">
    <div class="text-center w-1/4 mx-auto bg-white p-8 rounded-lg shadow-lg mt-[8.5%]">
      <h1 class="text-4xl font-extrabold text-gray-900">Login to Your Account</h1>
      <form class="mt-8" action="/login" method="post">
        <input type="email" name="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded mt-4" />
        <input type="password" name="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded mt-4" />
        <button type="submit" name="login" class="w-full bg-teal-600 text-white py-2 rounded mt-4 hover:bg-teal-700">Login</button>
      </form>
      <p class="mt-4 text-sm text-gray-600">
        Dont have an account? <a href="/register" class="text-teal-600 hover:text-teal-700">Register here</a>
      </p>
    </div>
  </section>

  <?php include '../views/components/footer.php'; ?>


</body>
</html>
