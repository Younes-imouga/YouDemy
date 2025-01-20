<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

<?php include '../views/components/header.php'; ?>


<section class="flex-grow container mx-auto mt-8">
    <div class="text-center w-1/4 mx-auto bg-white p-8 rounded-lg shadow-lg mt-[8.5%]">
      <h1 class="text-4xl font-extrabold text-gray-900">Create Your Account</h1>
      <form class="mt-8" method="post" action="/register">
        
      <input type="text" name="name" placeholder="UserName" class="w-full p-3 border border-gray-300 rounded mt-4" required />

        <input type="email" name="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded mt-4" required />

        <input type="password" name="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded mt-4" required />

        <div class="mt-4 text-left">
          <label for="role" class="block text-sm text-gray-600">Select your role</label>
          <select id="role" name="role" class="w-full p-3 border border-gray-300 rounded mt-2">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
          </select>
        </div>

        <button type="submit" name="register" class="w-full bg-teal-600 text-white py-2 rounded mt-4 hover:bg-teal-700">Sign Up</button>
      </form>
      <p class="mt-4 text-sm text-gray-600">
        Already have an account? <a href="/login" class="text-teal-600 hover:text-teal-700">Login here</a>
      </p>
    </div>
  </section>

  <?php include '../views/components/footer.php'; ?>


</body>
</html>
