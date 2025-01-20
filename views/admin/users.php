<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <main class="flex-grow container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">User Management</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 border border-gray-300 text-left">Username</th>
                        <th class="px-6 py-3 border border-gray-300 text-left">Email</th>
                        <th class="px-6 py-3 border border-gray-300 text-left">Status</th>
                        <th class="px-6 py-3 border border-gray-300 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="px-6 py-4 border border-gray-300"><?php echo htmlspecialchars($user['status']); ?></td>
                            <td class="px-6 py-4 border border-gray-300">
                                <form action="/admin/change-user-status" method="POST" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <?php if ($user['status'] === 'Suspended'): ?>
                                        <button type="submit" name="action" value="activate" class="text-green-600 hover:text-green-900 mr-3">Activate</button>
                                        <?php elseif ($user['status'] === 'Active'): ?>
                                            <button type="submit" name="action" value="deactivate" class="text-yellow-600 hover:text-yellow-900 mr-3">Deactivate</button>
                                    <?php endif; ?>
                                    <button type="submit" name="action" value="suspend" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to suspend this user?')">Suspend</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>

    <?php include '../views/components/footer.php'; ?>
</body>
</html>
