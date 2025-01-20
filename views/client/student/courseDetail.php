<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['course']['title']); ?> - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php require_once '../views/components/header.php'; ?>
<body class="flex flex-col min-h-screen bg-gray-50">
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="relative">
                    <div class="w-full h-72 "></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-8 right-8">
                        <span class="px-4 py-2 bg-teal-500 text-white text-sm font-semibold rounded-full mb-4 inline-block">
                            <?php echo htmlspecialchars($data['course']['category_name'] ?? 'Uncategorized'); ?>
                        </span>
                        <h1 class="text-4xl font-bold text-white mb-2">
                            <?php echo htmlspecialchars($data['course']['title']); ?>
                        </h1>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-gray-50 rounded-xl p-6">
                        <div class="text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-teal-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <p class="text-sm text-gray-500">Instructor</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($data['course']['teacher_name']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-teal-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="text-sm text-gray-500">Students Enrolled</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    <?php echo number_format($data['course']['student_count'] ?? 0); ?>
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-teal-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm text-gray-500">Content Type</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    <?php echo ucfirst(htmlspecialchars($data['course']['content_type'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($data['course']['tags'])): ?>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <?php foreach ($data['course']['tags'] as $tag): ?>
                                <span class="px-4 py-2 bg-teal-50 text-teal-700 text-sm rounded-full border border-teal-100 hover:bg-teal-100 transition-colors">
                                    <?php echo htmlspecialchars($tag['name']); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">About this course</h2>
                        <div class="text-gray-600 leading-relaxed bg-gray-50 rounded-xl p-6">
                            <?php echo nl2br(htmlspecialchars($data['course']['description'])); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <?php if (isset($_GET['error'])): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-xl">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$seeContent): ?>
                <form action="/enroll-course" method="POST" class="inline-block">
                    <input type="hidden" name="course_id" value="<?php echo $data['course']['id']; ?>">
                    <button type="submit" 
                            class="bg-teal-600 text-white px-12 py-4 rounded-xl font-semibold hover:bg-teal-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Enroll in Course
                    </button>
                </form>
                <?php else: ?>
                    <div class="text-center mt-4">
                        <a href="/student/courseContent?course_id=<?php echo $data['course']['id']; ?>" class="bg-teal-600 text-white px-12 py-4 rounded-xl font-semibold hover:bg-teal-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">View Course Content</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>
    <?php require_once '../views/components/footer.php'; ?>
</body>
</html>