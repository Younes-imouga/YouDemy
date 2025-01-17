<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Courses - Youdemy Teacher</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
  <main class="flex-grow container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
      <a href="/teacher/add-course" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Add New Course</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php echo htmlspecialchars($_GET['success']); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($data['courses']) && !empty($data['courses'])): ?>
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Students</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tags</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($data['courses'] as $course): ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <?php echo htmlspecialchars($course['title']); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?php echo htmlspecialchars($course['category_name'] ?? 'Uncategorized'); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?php echo htmlspecialchars($course['content_type']); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?php echo date('Y-m-d', strtotime($course['created_at'])); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?php echo $course['student_count'] ?? 0; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?php if (!empty($course['tags'])): ?>
                      <div class="flex flex-wrap gap-2">
                          <?php 
                          $displayTags = array_slice($course['tags'], 0, 3);
                          $remainingCount = count($course['tags']) - 3;
                          
                          foreach ($displayTags as $tag): ?>
                              <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">
                                  <?php echo htmlspecialchars($tag['name']); ?>
                              </span>
                          <?php endforeach; 
                          
                          if ($remainingCount > 0): ?>
                              <span class="px-2 py-1 bg-teal-100 text-teal-800 text-xs rounded-full flex items-center gap-1 cursor-help"
                                    title="<?php echo htmlspecialchars(implode(', ', array_map(function($tag) { return $tag['name']; }, array_slice($course['tags'], 3)))); ?>">
                                  +<?php echo $remainingCount; ?>
                              </span>
                          <?php endif; ?>
                      </div>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <a href="/teacher/edit-course/<?php echo $course['id']; ?>" class="text-teal-600 hover:text-teal-900 mr-3">Edit</a>
                  <a href="/teacher/course-stats/<?php echo $course['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Stats</a>
                  <form action="/teacher/delete-course" method="POST" class="inline">
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
        <p class="text-xl text-gray-600">You haven't created any courses yet.</p>
        <a href="/teacher/add-course" class="mt-4 inline-block bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-700">Create Your First Course</a>
      </div>
    <?php endif; ?>
  </main>

  <?php include '../views/components/footer.php'; ?>
</body>
</html>
