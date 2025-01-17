<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Available Courses - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
  <main class="flex-grow container mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-4xl font-bold text-gray-900">Available Courses</h1>
      <div class="relative">
        <input type="text" 
               placeholder="Search courses..." 
               class="px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
      </div>
    </div>

    <?php if (isset($data['courses']) && !empty($data['courses'])): ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($data['courses'] as $course): ?>
          <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
            <img src="https://via.placeholder.com/400x250" alt="Course Image" 
                 class="w-full h-48 object-cover">
            
            <div class="p-6">
              <div class="flex items-center mb-2">
                <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-semibold rounded-full">
                  <?php echo htmlspecialchars($course['category_name'] ?? 'Uncategorized'); ?>
                </span>
              </div>

              <h2 class="text-2xl font-bold text-gray-900 mb-2 line-clamp-2">
                <a href="/course/<?php echo (int)$course['id']; ?>" class="hover:text-teal-600 transition-colors">
                  <?php echo htmlspecialchars($course['title']); ?>
                </a>
              </h2>
              
              <h3 class="text-lg font-semibold text-gray-700 mb-2">
                <?php echo htmlspecialchars($course['teacher_name']); ?>
              </h3>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                <?php echo htmlspecialchars($course['description']); ?>
              </p>

              <?php if (!empty($course['tags'])): ?>
                <div class="flex flex-wrap gap-2 mb-4">
                  <?php 
                  $displayTags = array_slice($course['tags'], 0, 3);
                  $remainingCount = count($course['tags']) - 3;
                  
                  foreach ($displayTags as $tag): ?>
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full hover:bg-gray-200 transition-colors">
                      <?php echo htmlspecialchars($tag['name']); ?>
                    </span>
                  <?php endforeach; 
                  
                  if ($remainingCount > 0): ?>
                    <span class="px-2 py-1 bg-teal-100 text-teal-800 text-xs rounded-full flex items-center gap-1 hover:bg-teal-200 transition-colors cursor-help" 
                          title="<?php echo htmlspecialchars(implode(', ', array_map(function($tag) { return $tag['name']; }, array_slice($course['tags'], 3)))); ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                      </svg>
                      <?php echo $remainingCount; ?>
                    </span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <a href="/course/<?php echo $course['id']; ?>" 
                   class="text-teal-600 hover:text-teal-800 font-semibold">
                  View Details →
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="text-center py-12">
        <p class="text-xl text-gray-600">No courses available at the moment.</p>
      </div>
    <?php endif; ?>
  </main>

  <?php include '../views/components/footer.php'; ?>
</body>
</html>
