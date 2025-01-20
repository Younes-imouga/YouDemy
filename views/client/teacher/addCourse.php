<?php include '../views/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youdemy Platform - Add Course</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800 font-sans">
  <main class="flex-grow container mx-auto mt-8">
    <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">Add New Course</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
      <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php endif; ?>

      <form action="/teacher/add-course" method="POST" class="space-y-6" enctype="multipart/form-data">
        <div>
          <label for="title" class="block text-gray-700 font-semibold mb-2">Course Title</label>
          <input type="text" id="title" name="title" required
                 class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500"
                 placeholder="Enter course title">
        </div>

        <div>
          <label for="description" class="block text-gray-700 font-semibold mb-2">Course Description</label>
          <textarea id="description" name="description" required rows="4" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500" placeholder="Enter course description"></textarea>
        </div>

        <div>
          <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
          <select id="category" name="category_id" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500">
            <option value="">Select a category</option>
            <?php foreach ($data['categories'] as $category): ?>
              <option value="<?php echo $category['id']; ?>">
                <?php echo htmlspecialchars($category['name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <label for="content_type" class="block text-gray-700 font-semibold mb-2">Content Type</label>
          <select id="content_type" name="content_type" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500">
            <option value="">Select content type</option>
            <option value="video">Video</option>
            <option value="document">Document</option>
          </select>
        </div>

        <div id="contentUpload" class="space-y-4">
            <div id="videoUpload" class="hidden">
                <label for="video_url" class="block text-gray-700 font-semibold mb-2">Video URL (YouTube/Vimeo)</label>
                <input type="url" id="video_url" name="video_url"  class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500" placeholder="Enter video URL">
            </div>

            <div id="documentUpload" class="hidden">
                <label for="pdf_file" class="block text-gray-700 font-semibold mb-2">PDF Document</label>
                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500">
                <p class="text-sm text-gray-500 mt-1">Maximum file size: 10MB</p>
            </div>
        </div>

        <div>
          <label for="tags" class="block text-gray-700 font-semibold mb-2">Tags</label>
          <select id="multiSelect" multiple name="tags[]" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-teal-500"> 
            <?php foreach ($data['tags'] as $tag): ?>
              <option value="<?php echo htmlspecialchars($tag['id'])?>"><?php echo htmlspecialchars($tag['name']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" 
                class="w-full bg-teal-600 text-white py-3 px-4 rounded hover:bg-teal-700 transition duration-200">
          Create Course
        </button>
      </form>
    </div>
  </main>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const multiSelect = new Choices("#multiSelect", {
        removeItemButton: true,
        placeholder: true,
        placeholderValue: "Select multiple options...",
      });
    });

    document.getElementById('content_type').addEventListener('change', function() {
        const videoUpload = document.getElementById('videoUpload');
        const documentUpload = document.getElementById('documentUpload');
        
        if (this.value === 'video') {
            videoUpload.classList.remove('hidden');
            documentUpload.classList.add('hidden');
            document.getElementById('video_url').required = true;
            document.getElementById('pdf_file').required = false;
        } else if (this.value === 'document') {
            documentUpload.classList.remove('hidden');
            videoUpload.classList.add('hidden');
            document.getElementById('pdf_file').required = true;
            document.getElementById('video_url').required = false;
        } else {
            videoUpload.classList.add('hidden');
            documentUpload.classList.add('hidden');
            document.getElementById('video_url').required = false;
            document.getElementById('pdf_file').required = false;
        }
    });
  </script>
  <?php include '../views/components/footer.php'; ?>
</body>
</html>
