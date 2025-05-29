<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Bookmark Artikel')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Bookmark Artikel'))]); ?>
    <div class="min-h-screen flex flex-col">
        <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
        <!-- Konten utama bookmarks -->
        <div class="flex-1">
            <div class="max-w-5xl mx-auto mt-8">
                <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Artikel yang Disimpan</h1>
                <?php
                    $perPage = 6;
                    $page = request()->get('page', 1);
                    $total = $bookmarks->count();
                    $totalPages = ceil($total / $perPage);
                    $currentBookmarks = $bookmarks->forPage($page, $perPage)->values();
                ?>
                <?php if($currentBookmarks->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $currentBookmarks->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $art = $bookmark->article; ?>
                            <?php if($art): ?>
                            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 flex flex-col">
                                <a href="<?php echo e(route('artikel.show', $art->id)); ?>" class="block">
                                    <img src="<?php echo e(asset('storage/' . $art->featured_image)); ?>" alt="Gambar Artikel" class="rounded-t-xl h-40 w-full object-cover">
                                </a>
                                <div class="p-4 flex-1 flex flex-col">
                                    <span class="text-xs text-blue-600 font-semibold mb-2"><?php echo e($art->genre); ?></span>
                                    <h2 class="font-bold text-lg text-gray-900 dark:text-white mb-2 line-clamp-2">
                                        <?php echo e(Str::limit($art->title, 16, '...')); ?>

                                    </h2>
                                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                        <?php echo e(Str::limit($art->subheadline, 32, '...')); ?>

                                    </p>
                                    <div class="flex items-center justify-between mt-auto gap-2">
                                        <button type="button" class="text-red-500 hover:underline font-medium" onclick="showDeleteModal(<?php echo e($art->id); ?>)">Hapus Bookmark</button>
                                        <form id="delete-bookmark-form-<?php echo e($art->id); ?>" method="POST" action="<?php echo e(route('artikel.unbookmark', $art->id)); ?>" style="display:none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- PAGINATION -->
                <?php if($totalPages > 1): ?>
                <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                    <?php if($page > 1): ?>
                        <a href="?page=<?php echo e($page - 1); ?>" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">&laquo; Sebelumnya</a>
                    <?php endif; ?>
                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo e($i); ?>" class="px-4 py-2 rounded font-semibold transition select-none text-black bg-transparent <?php echo e($i == $page ? 'bg-yellow-200 text-yellow-900 font-bold border border-yellow-400' : ''); ?>" style="border:none; box-shadow:none; opacity:<?php echo e($i == $page ? '1' : '0.5'); ?>;">
                            <?php echo e($i); ?>

                        </a>
                    <?php endfor; ?>
                    <?php if($page < $totalPages): ?>
                        <a href="?page=<?php echo e($page + 1); ?>" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">Selanjutnya &raquo;</a>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                    <span class="px-4 py-2 rounded font-semibold select-none text-black bg-transparent border border-yellow-200" style="opacity:1;">1</span>
                </div>
                <?php endif; ?>
                <?php else: ?>
                    <div class="text-gray-500 text-lg">Belum ada artikel yang disimpan.</div>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-sm w-full text-center">
                <h2 class="text-xl font-bold mb-4 text-red-700">Hapus Bookmark?</h2>
                <p class="mb-6 text-gray-700">Apakah Anda yakin ingin menghapus artikel ini dari bookmark?</p>
                <div class="flex justify-center gap-4">
                    <button onclick="hideDeleteModal()" class="px-4 py-2 rounded font-semibold" style="background:#e5e7eb !important; color:#1f2937 !important; border:none !important;">Batal</button>
                    <button id="modal-delete-btn" class="px-4 py-2 rounded font-bold" style="background:#dc2626 !important; color:#fff !important; border:none !important;">Ya, Hapus</button>
                </div>
            </div>
        </div>
        <script>
            let deleteTargetId = null;
            function showDeleteModal(id) {
                deleteTargetId = id;
                document.getElementById('delete-modal').classList.remove('hidden');
            }
            function hideDeleteModal() {
                deleteTargetId = null;
                document.getElementById('delete-modal').classList.add('hidden');
            }
            document.getElementById('modal-delete-btn').onclick = function() {
                if(deleteTargetId) {
                    document.getElementById('delete-bookmark-form-' + deleteTargetId).submit();
                }
            };
        </script>
        <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/bookmarks.blade.php ENDPATH**/ ?>