<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Hasil Pencarian']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Hasil Pencarian']); ?>
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
    <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <div class="flex-1">
            <h2 class="text-2xl font-extrabold text-blue-700 mb-6">Hasil Pencarian: <span class="text-gray-800"><?php echo e(request('q')); ?></span></h2>
            <?php if($articles->count()): ?>
                <?php $__currentLoopData = $articles->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('artikel.show', $art->id)); ?>" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group">
                            <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                <img src="<?php echo e(asset('storage/' . $art->featured_image)); ?>" alt="<?php echo e($art->title); ?>" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                            </div>
                            <div class="flex-1 flex flex-col items-center p-5">
                                <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-center"
                                    style="color: #111 !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                    <?php echo e(Str::limit($art->title, 15, '...')); ?>

                                </h4>
                                <?php if(!empty($art->subheadline)): ?>
                                <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-center"
                                    style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                    <?php echo e(Str::limit($art->subheadline, 25, '...')); ?>

                                </h5>
                                <?php endif; ?>
                                <span class="text-blue-700 text-xs mt-2 text-center"><?php echo e(\Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y')); ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php for($i = count($row); $i < 4; $i++): ?>
                        <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
                            <div class="text-blue-200 text-lg font-semibold">-</div>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="mt-8 flex justify-center">
                    <?php echo e($articles->appends(['q'=>request('q')])->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-gray-500 text-lg">Tidak ada artikel yang cocok dengan pencarian Anda.</div>
            <?php endif; ?>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const resultsDropdown = document.getElementById('search-autocomplete-results');
    let debounceTimeout = null;
    let lastQuery = '';

    function showDropdown(items) {
        if (!items.length) {
            resultsDropdown.innerHTML = '<li class="px-4 py-2 text-gray-400">Tidak ada hasil</li>';
            resultsDropdown.classList.remove('hidden');
            return;
        }
        resultsDropdown.innerHTML = items.map(item =>
            `<li class="px-4 py-2 hover:bg-blue-50 cursor-pointer" data-id="${item.id}">${item.title}</li>`
        ).join('');
        resultsDropdown.classList.remove('hidden');
    }

    function hideDropdown() {
        resultsDropdown.classList.add('hidden');
    }

    searchInput.addEventListener('input', function(e) {
        const query = this.value.trim();
        if (debounceTimeout) clearTimeout(debounceTimeout);
        if (!query) {
            hideDropdown();
            return;
        }
        debounceTimeout = setTimeout(() => {
            fetch(`/artikel/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    showDropdown(data);
                });
        }, 200);
    });

    searchInput.addEventListener('focus', function() {
        if (resultsDropdown.innerHTML && !resultsDropdown.classList.contains('hidden')) {
            resultsDropdown.classList.remove('hidden');
        }
    });
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsDropdown.contains(e.target)) {
            hideDropdown();
        }
    });
    resultsDropdown.addEventListener('mousedown', function(e) {
        if (e.target.tagName === 'LI' && e.target.dataset.id) {
            window.location.href = `/artikel/${e.target.dataset.id}`;
        }
    });
    // Enter: ke halaman hasil pencarian
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = this.value.trim();
            if (query) {
                window.location.href = `/search-results?q=${encodeURIComponent(query)}`;
            }
        }
    });
});
</script>
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
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/search-results.blade.php ENDPATH**/ ?>