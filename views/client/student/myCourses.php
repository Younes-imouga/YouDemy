<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">My Enrolled Courses</h1>
    <p class="text-lg text-gray-600 mt-2">Here are the courses you've enrolled in:</p>

    <div class="mt-6 space-y-4">
        <?php if (isset($data['courses']) && !empty($data['courses'])): ?>
            <?php foreach ($data['courses'] as $course): ?>
                <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800"><?php echo htmlspecialchars($course['title']); ?></h2>
                        <p class="text-gray-600">Instructor: <?php echo htmlspecialchars($course['teacher_name']); ?></p>
                        <p class="text-gray-600">Category: <?php echo htmlspecialchars($course['category_name'] ?? 'Uncategorized'); ?></p>
                    </div>
                    <a href="/course/<?php echo $course['id']; ?>" class="text-teal-600 hover:underline">Go to Course</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="bg-white p-4 rounded-lg shadow">
                <p class="text-gray-600">You are not enrolled in any courses yet.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-6">
        <?php if (isset($data['pagination']) && $data['pagination']['lastPage'] > 1): ?>
            <div class="flex items-center justify-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
                <div class="inline-flex rounded-md shadow-sm">
                    <?php if ($data['pagination']['currentPage'] > 1): ?>
                        <a href="my-courses?page=<?php echo ($data['pagination']['currentPage'] - 1); ?>"
                           class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                            Previous
                        </a>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $data['pagination']['currentPage'] - 2);
                    $end = min($data['pagination']['lastPage'], $start + 4);
                    
                    for ($i = $start; $i <= $end; $i++): ?>
                        <a href="my-courses?page=<?php echo $i; ?>"
                           class="px-4 py-2 text-sm font-medium <?php echo $i === $data['pagination']['currentPage'] 
                                ? 'text-white bg-teal-600 border border-teal-600' 
                                : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($data['pagination']['currentPage'] < $data['pagination']['lastPage']): ?>
                        <a href="my-courses?page=<?php echo ($data['pagination']['currentPage'] + 1); ?>"
                           class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                            Next
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
      </div>
</main>

<?php include '../views/components/footer.php'; ?>

</body>
</html>