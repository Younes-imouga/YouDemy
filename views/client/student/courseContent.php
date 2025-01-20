<?php include '../views/components/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['course']['title']); ?> - Course Content</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-6"><?php echo htmlspecialchars($data['course']['title']); ?></h1>
    
    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Course Content</h2>
        
        <?php if ($data['course']['content_type'] === 'video'): ?>
            <iframe width="100%" height="800" src="<?php echo htmlspecialchars($data['course']['content_url']); ?>" frameborder="0" allowfullscreen></iframe>
        <?php elseif ($data['course']['content_type'] === 'document'): ?>
            <iframe src="../<?php echo htmlspecialchars($data['course']['content_path']); ?>" width="100%" height="800"></iframe>
        <?php else: ?>
            <p class="text-gray-600">No content available for this course.</p>
        <?php endif; ?>
    </div>
</main>

<?php include '../views/components/footer.php'; ?>
</body>
</html>
