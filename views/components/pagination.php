<?php
function renderPagination($currentPage, $lastPage, $baseUrl) {
    if ($lastPage <= 1) return;
    ?>
    <div class="flex items-center justify-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
        <div class="inline-flex rounded-md shadow-sm">
            <?php if ($pagination['currentPage'] > 1): ?>
                <a href="<?php echo $baseUrl; ?>?page=<?php echo ($pagination['currentPage'] - 1); ?>"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                    Previous
                </a>
            <?php endif; ?>

            <?php
            $start = max(1, $pagination['currentPage'] - 2);
            $end = min($pagination['lastPage'], $start + 4);
            
            for ($i = $start; $i <= $end; $i++): ?>
                <a href="<?php echo $baseUrl; ?>?page=<?php echo $i; ?>"
                   class="px-4 py-2 text-sm font-medium <?php echo $i === $pagination['currentPage'] 
                        ? 'text-white bg-teal-600 border border-teal-600' 
                        : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($pagination['currentPage'] < $pagination['lastPage']): ?>
                <a href="<?php echo $baseUrl; ?>?page=<?php echo ($pagination['currentPage'] + 1); ?>"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                    Next
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
?> 