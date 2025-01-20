<?php include '../views/components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Category Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

    <main class="flex-grow container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Category Management</h1>

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

        <div class="overflow-x-auto bg-white shadow rounded-lg p-4 mb-6">
            <div class="mt-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Add New Category</h2>
                <form action="/admin/add-category" method="POST" class="flex items-center space-x-4">
                    <input type="text" name="name" placeholder="Category Name" required class="p-2 border border-gray-300 rounded w-1/3" />
                    <input type="text" name="description" placeholder="Description" class="p-2 border border-gray-300 rounded w-1/3" />
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Add</button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
            <?php if (isset($data['categories']) && !empty($data['categories'])): ?>
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Category Name</th>
                            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Description</th>
                            <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['categories'] as $category): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border border-gray-300 text-sm"><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="px-6 py-4 border border-gray-300 text-sm"><?php echo htmlspecialchars($category['description']); ?></td>
                                <td class="px-6 py-4 border border-gray-300 text-sm space-x-4">
                                    <form action="/admin/edit-category" method="POST" class="inline">
                                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                        <button class="text-teal-600 hover:underline">Edit</button>
                                    </form>
                                    <form action="/admin/delete-category" method="POST" class="inline">
                                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="mt-6">
                    <?php if (isset($data['pagination']) && $data['pagination']['lastPage'] > 1): ?>
                        <div class="flex items-center justify-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
                            <div class="inline-flex rounded-md shadow-sm">
                                <?php if ($data['pagination']['currentPage'] > 1): ?>
                                    <a href="/admin/categories?page=<?php echo ($data['pagination']['currentPage'] - 1); ?>"
                                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                                        Previous
                                    </a>
                                <?php endif; ?>

                                <?php
                                $start = max(1, $data['pagination']['currentPage'] - 2);
                                $end = min($data['pagination']['lastPage'], $start + 4);
                                
                                for ($i = $start; $i <= $end; $i++): ?>
                                    <a href="/admin/categories?page=<?php echo $i; ?>"
                                       class="px-4 py-2 text-sm font-medium <?php echo $i === $data['pagination']['currentPage'] 
                                            ? 'text-white bg-teal-600 border border-teal-600' 
                                            : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>

                                <?php if ($data['pagination']['currentPage'] < $data['pagination']['lastPage']): ?>
                                    <a href="/admin/categories?page=<?php echo ($data['pagination']['currentPage'] + 1); ?>"
                                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                                        Next
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600 text-center mt-4">No categories found.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php include '../views/components/footer.php'; ?>


</body>
</html>
