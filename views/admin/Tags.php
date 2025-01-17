<?php include '../views/components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Tag Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">


  <!-- Content -->
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tag Management</h1>

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

    <!-- Add New Tag -->
    <div class="overflow-x-auto bg-white shadow rounded-lg p-4 mb-6">
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Add New Tag</h2>
            <form action="/admin/add-tag" method="POST" class="flex items-center space-x-4">
                <input name="tags" class="p-2 border border-gray-300 rounded w-1/3" placeholder="Enter tags">
                <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Add</button>
            </form>
        </div>
    </div>

    <!-- Table for Tag Management -->
    <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
        <?php if (isset($data['tags']) && !empty($data['tags'])): ?>
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Tag Name</th>
                        <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['tags'] as $tag): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border border-gray-300 text-sm"><?php echo htmlspecialchars($tag['name']); ?></td>
                            <td class="px-6 py-4 border border-gray-300 text-sm space-x-4">
                                <form action="/admin/delete-tag" method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-600 text-center mt-4">No tags found.</p>
        <?php endif; ?>
    </div>
  </main>

  <?php include '../views/components/footer.php'; ?>

  <script>
    var input = document.querySelector('input[name=tags]');

    new Tagify(input, {
        delimiters: ',',
        enforceWhitelist: false,
        editTags: false,
        originalInputValueFormat: valuesArr => JSON.stringify(valuesArr)
    });
</script>

</body>
</html>
