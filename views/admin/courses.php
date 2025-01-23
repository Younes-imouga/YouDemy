<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Management - Youdemy Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
  <main class="flex-grow container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Course Management</h1>
    </div>

    <?php if (isset($_GET['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php echo htmlspecialchars($_GET['success']); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?php echo htmlspecialchars($_GET['error']); ?>
      </div>
    <?php endif; ?>
    
    <?php if (isset($data['courses']) && !empty($data['courses'])): ?>
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-6 py-3 border border-gray-300 text-left">Title</th>
              <th class="px-6 py-3 border border-gray-300 text-left">Teacher</th>
              <th class="px-6 py-3 border border-gray-300 text-left">Category</th>
              <th class="px-6 py-3 border border-gray-300 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['courses'] as $course): ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($course['title']); ?></td>
                <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($course['teacher_name']); ?></td>
                <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($course['category_name']); ?></td>
                <td class="px-6 py-4 border border-gray-300">
                  <a href="/course/<?php echo $course['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Stats</a>
                  <form action="/admin/delete-course" method="POST" class="inline">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <p class="text-xl text-gray-600">No courses available at this time.</p>
        <a href="/admin/add-course" class="mt-4 inline-block bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">Add Your First Course</a>
      </div>
    <?php endif; ?>
  </main>

  <?php include '../views/components/footer.php'; ?>
</body>
</html>
