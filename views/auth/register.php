<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="#" class="text-2xl font-bold text-teal-600">Youdemy</a>
      <nav class="space-x-4">
        <a href="/" class="text-gray-700 hover:text-teal-600">Home</a>
        <a href="/courses" class="text-gray-700 hover:text-teal-600">Courses</a>
        <a href="/login" class="text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white">Login</a>
        <a href="/register" class="text-teal-600 border border-teal-600 px-4 py-1 rounded hover:bg-teal-600 hover:text-white">Sign Up</a>
      </nav>
    </div>
  </header>

  <!-- Sign Up Content -->
  <section class="flex-grow container mx-auto mt-8">
    <div class="text-center w-1/4 mx-auto bg-white p-8 rounded-lg shadow-lg mt-[8.5%]">
      <h1 class="text-4xl font-extrabold text-gray-900">Create Your Account</h1>
      <form class="mt-8" method="post" action="/register">
        <!-- Name Input -->
        <input type="text" name="name" placeholder="UserName" class="w-full p-3 border border-gray-300 rounded mt-4" required />

      <!-- Email Input -->
        <input type="email" name="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded mt-4" required />

        <!-- Password Input -->
        <input type="password" name="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded mt-4" required />

        <!-- Role Selection -->
        <div class="mt-4 text-left">
          <label for="role" class="block text-sm text-gray-600">Select your role</label>
          <select id="role" name="role" class="w-full p-3 border border-gray-300 rounded mt-2">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
          </select>
        </div>

        <!-- Sign Up Button -->
        <button type="submit" name="register" class="w-full bg-teal-600 text-white py-2 rounded mt-4 hover:bg-teal-700">Sign Up</button>
      </form>
      <p class="mt-4 text-sm text-gray-600">
        Already have an account? <a href="/login" class="text-teal-600 hover:text-teal-700">Login here</a>
      </p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto text-center p-4">
      <p class="text-sm">© 2025 Youdemy - All Rights Reserved</p>
      <nav class="space-x-4 mt-2">
        <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
        <a href="#" class="text-gray-400 hover:text-white">Terms of Service</a>
      </nav>
    </div>
  </footer>

</body>
</html>
