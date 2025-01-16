<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Approvals - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <main class="flex-grow container mx-auto py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Teacher Approval Requests</h1>
            
            <?php if (isset($data['pendingTeachers']) && !empty($data['pendingTeachers'])): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['pendingTeachers'] as $teacher): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo htmlspecialchars($teacher['username']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($teacher['email']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="/admin/approve-teacher" method="POST" class="inline">
                                            <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mr-2 hover:bg-green-600 transition">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="/admin/reject-teacher" method="POST" class="inline">
                                            <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                                Refuse
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-gray-600 text-center py-8">No pending teacher requests at this time.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../views/components/footer.php'; ?>
</body>
</html> 