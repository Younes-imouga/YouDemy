<footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto text-center p-4">
        <p class="text-sm">© 2025 Youdemy - All Rights Reserved</p>
        <nav class="space-x-4 mt-2">
            <a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a>
            <a href="/terms" class="text-gray-400 hover:text-white">Terms of Service</a>
            <?php if (isset($_SESSION['Logged_in'])): ?>
                <a href="/support" class="text-gray-400 hover:text-white">Support</a>
            <?php endif; ?>
        </nav>
    </div>
</footer> 