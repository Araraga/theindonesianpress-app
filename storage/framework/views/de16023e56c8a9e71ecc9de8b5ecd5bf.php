<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Edit Artikel')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Artikel'))]); ?>
    <div class="min-h-screen flex flex-col" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
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
        <main class="flex-1 flex flex-col items-center justify-center py-10 px-2 md:px-0">
            <div class="w-full max-w-5xl mx-auto rounded-2xl shadow-2xl p-10 md:p-16 mt-8 border-4 border-blue-200 dark:border-blue-700 backdrop-blur-xl" style="background: linear-gradient(180deg, #2A2A2A 0%, #3A4B57 100%);">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-8 text-center tracking-wide font-serif">Edit Artikel</h1>
                <form action="<?php echo e(route('artikel.update', $article->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <?php echo csrf_field(); ?>
                    <div class="flex flex-col gap-6">
                        <input type="text" name="title" required class="text-4xl md:text-5xl font-extrabold bg-transparent border-none focus:ring-0 focus:outline-none text-gray-900 dark:text-white placeholder:italic placeholder:text-gray-400 mb-2" placeholder="Judul Berita..." value="<?php echo e(old('title', $article->title)); ?>" autofocus>
                        <input type="text" name="subheadline" required class="text-xl md:text-2xl font-semibold bg-transparent border-none focus:ring-0 focus:outline-none text-gray-700 dark:text-gray-300 placeholder:italic placeholder:text-gray-400 mb-4" placeholder="Subheadline (opsional)..." value="<?php echo e(old('subheadline', $article->subheadline)); ?>">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-1 flex flex-col items-center bg-blue-50 dark:bg-neutral-900 rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-blue-700 dark:text-blue-200 mb-3">Genre</label>
                                <select name="genre" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-white dark:bg-neutral-900 text-blue-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold">
                                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($genre); ?>" <?php echo e(old('genre', $article->genre) == $genre ? 'selected' : ''); ?>><?php echo e($genre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="flex-1 flex flex-col items-center bg-blue-50 dark:bg-neutral-900 rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-blue-700 dark:text-blue-200 mb-3">Gambar Utama (biarkan kosong jika tidak ingin ganti)</label>
                                <input type="file" name="featured_image" accept="image/*" class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-white dark:bg-neutral-900 text-blue-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" />
                                <img src="<?php echo e(asset('storage/' . $article->featured_image)); ?>" alt="Gambar Saat Ini" class="mt-4 rounded-xl max-h-40">
                            </div>
                        </div>
                        <textarea name="content" rows="22" required class="w-full text-lg md:text-xl bg-transparent border-none focus:ring-0 focus:outline-none text-gray-900 dark:text-white placeholder:italic placeholder:text-gray-400 resize-none min-h-[500px]"><?php echo e(old('content', $article->content)); ?></textarea>
                    </div>
                    <div class="flex justify-between items-center gap-4 mt-10">
                        <a href="<?php echo e(route('artikel.show', $article->id)); ?>" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-gray-200 dark:bg-neutral-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-neutral-600 transition">
                            Batal
                        </a>
                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
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
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/edit-article.blade.php ENDPATH**/ ?>