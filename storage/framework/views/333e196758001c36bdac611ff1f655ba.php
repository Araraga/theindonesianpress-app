<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Tulis Artikel')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Tulis Artikel'))]); ?>
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
            <div class="w-full max-w-5xl mx-auto rounded-2xl shadow-2xl p-10 md:p-16 mt-8 border-4 border-blue-200 dark:border-blue-700 backdrop-blur-xl" style="background: #171717f7;">
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#FFF6BE] !text-[#FFF6BE] mb-8 text-center tracking-wide font-serif" style="color:#FFF6BE !important;">Tulis Artikel Baru</h1>
                <form action="<?php echo e(route('artikel.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <?php echo csrf_field(); ?>
                    <div class="flex flex-col gap-6">
                        <input type="text" name="title" required class="text-xl md:text-x2 font-extrabold bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] mb-2" placeholder="Judul Berita..." value="<?php echo e(old('title')); ?>" autofocus>
                        <input type="text" name="subheadline" required class="text-xl md:text-2xl font-normal bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] mb-4" placeholder="Subheadline (opsional)..." value="<?php echo e(old('subheadline')); ?>">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-1 flex flex-col items-center bg-transparent rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-[#FFF6BE] !text-[#FFF6BE] mb-3" style="color:#FFF6BE !important;">Genre</label>
                                <select name="genre" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-[#232323] text-[#fefefe] focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" style="color:#fefefe;">
                                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($genre); ?>" style="color:#111 !important; background:#fff;" <?php echo e(old('genre') == $genre ? 'selected style=color:#fefefe!important;background:#232323;' : ''); ?>><?php echo e($genre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="flex-1 flex flex-col items-center bg-transparent rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-[#FFF6BE] !text-[#FFF6BE] mb-3" style="color:#FFF6BE !important;">Gambar Utama</label>
                                <input type="file" name="featured_image" accept="image/*" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-[#232323] text-[#fefefe] focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" />
                            </div>
                        </div>
                        <textarea name="content" rows="22" required class="w-full text-lg md:text-xl bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] resize-none min-h-[500px]" placeholder="Tulis narasi berita, opini, atau laporan Anda di sini. Mulailah dengan paragraf pembuka yang menarik, lalu lanjutkan dengan isi berita secara natural..."><?php echo e(old('content')); ?></textarea>
                    </div>
                    <div class="flex justify-between items-center gap-4 mt-10">
                        <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-[#232323] text-[#fefefe] font-semibold hover:bg-[#333] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Kembali
                        </a>
                        <div class="flex gap-4">
                            <button type="reset" class="px-6 py-2 rounded-lg bg-[#232323] text-[#fefefe] font-semibold hover:bg-[#333] transition">Reset</button>
                            <button type="submit" class="px-6 py-2 rounded-lg" style="background:#7E2320; color:#FFF6BE; font-weight:600;">Terbitkan Artikel</button>
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
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/write-article.blade.php ENDPATH**/ ?>