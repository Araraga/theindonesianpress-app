<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => __('Dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Dashboard'))]); ?>
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
        <!-- Area Konten Dinamis -->
        <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
            <div id="content-beranda" class="flex-1">
                <?php if($selectedGenre): ?>
                    <div class="mb-10">
                        <h4 class="text-2xl font-extrabold text-blue-700 mb-8 flex items-center gap-2"><?php echo e(strtoupper($selectedGenre)); ?></h4>
                        <?php
                            $perPage = 12;
                            $page = request()->get('page', 1);
                            $total = $articles->count();
                            $totalPages = ceil($total / $perPage);
                            $currentArticles = $articles->forPage($page, $perPage)->values();
                        ?>
                        <?php $__currentLoopData = $currentArticles->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    </div>
                <?php else: ?>
                    <!-- Headline / Berita Hots & Top 3 Populer Minggu Ini -->
                    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-center items-start">
                        <!-- Headline Besar: Label di atas gambar, info di bawah gambar, label lebih besar, gap lebih lebar, rata kiri -->
                        <div class="flex-[10] relative bg-gradient-to-br from-red-700 via-yellow-100 to-blue-700/80 rounded-2xl shadow-2xl flex flex-col items-stretch justify-between min-w-[320px] max-w-[900px] border-4 border-blue-400 overflow-hidden">
                            <a href="<?php echo e($headline ? route('artikel.show', $headline->id) : '#'); ?>" class="block w-full h-full no-underline text-inherit group">
                                <div class="relative w-[720px] h-[310px] max-w-full mx-auto flex items-center justify-center bg-blue-100/60 backdrop-blur-xl overflow-hidden border-4 border-blue-400 shadow-xl" style="border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;">
                                    <span class="absolute top-0 left-0 w-full text-3xl md:text-4xl font-extrabold py-4 px-0 uppercase tracking-wider text-center bg-red-700 text-white shadow-xl animate-pulse drop-shadow-xl z-20"
                                        style="background: #b91c1c !important; color: #fff !important; border-radius: 0 !important; letter-spacing:0.12em; font-family: 'Playfair Display', 'Merriweather', serif;">
                                        BERITA PALING PANAS MINGGU INI
                                    </span>
                                    <?php if($headline): ?>
                                        <img id="headline-img" src="<?php echo e(asset('storage/' . $headline->featured_image)); ?>" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    <?php else: ?>
                                        <img id="headline-img" src="<?php echo e(asset('images/placeholder-hots.png')); ?>" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    <?php endif; ?>
                                    <!-- Tanggal di dalam gambar, pojok kanan bawah -->
                                    <span style="position:absolute; right:0; bottom:0; margin:16px; z-index:10; background: #1e40afcc !important; color: #fff !important; border: 1px solid #2563eb !important;" class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900/90 text-white text-xs font-bold shadow border border-blue-200 font-mono">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        <span class="truncate max-w-[120px]"><?php echo e($headline ? $headline->created_at->format('d M Y') : '-'); ?></span>
                                    </span>
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center bg-gradient-to-br from-slate-200 via-blue-200 to-slate-100 shadow-xl border-x-4 border-b-4 border-blue-400 max-w-[720px] mx-auto w-[720px] -mt-1 p-8 gap-2"
                                     style="background: linear-gradient(135deg,rgb(36, 37, 39) 10%,rgb(46, 46, 46) 100%) !important; border-radius: 0 !important;">
                                    <!-- Genre kiri, headline kiri, headline 2 kiri -->
                                    <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-blue-900 text-white text-xs font-semibold shadow border border-white/80 mb-2 font-mono tracking-wide"
                                          style="background: #1e40af !important; color: #fff !important; border: 1px solid #fff !important;">
                                        <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><path d="M4 4h12v12H4z"/><path d="M4 9h12"/></svg>
                                        <span class="truncate max-w-[120px]"><?php echo e($headline?->genre ?? '-'); ?></span>
                                    </span>
                                    <h2 class="font-extrabold text-2xl md:text-3xl text-white mb-1 font-serif leading-tight tracking-tight drop-shadow-xl text-left w-full"
                                        style="font-family: 'Playfair Display', 'Merriweather', serif; letter-spacing:0.01em; color: #fff !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        <?php echo e(Str::limit($headline?->title ?? 'Judul Headline Utama Minggu Ini', 40, '...')); ?>

                                    </h2>
                                    <?php if(!empty($headline?->subheadline)): ?>
                                    <h3 class="font-bold text-lg md:text-xl text-blue-200 mb-1 font-serif leading-tight tracking-tight drop-shadow text-left w-full"
                                        style="font-family: 'Playfair Display', 'Merriweather', serif; letter-spacing:0.01em; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        <?php echo e(Str::limit($headline?->subheadline, 60, '...')); ?>

                                    </h3>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <!-- Top 3 Populer Mini: 3 Berita Terpopuler Minggu Ini (tinggi card lebih besar dan lebih naik ke atas) -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold text-blue-700 mb-2 tracking-wide">Paling Populer</div>
                            <?php $__currentLoopData = $top3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('artikel.show', $pop->id)); ?>" class="flex flex-row items-start gap-5 bg-white/90 rounded-2xl shadow-2xl border-2 border-blue-200 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-blue-400/40 no-underline">
                                <div class="absolute -left-4 top-1/2 -translate-y-1/2 z-10">
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full text-white text-xl font-black shadow-lg border-2 border-white/80 animate-bounce"
                                        style="
                                            <?php if($loop->iteration == 1): ?>
                                                background: linear-gradient(135deg, #f59e42 0%, #eab308 100%) !important;
                                                color: #fff !important;
                                            <?php elseif($loop->iteration == 2): ?>
                                                background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important;
                                                color: #fff !important;
                                            <?php elseif($loop->iteration == 3): ?>
                                                background: linear-gradient(135deg, #38bdf8 0%, #1e40af 100%) !important;
                                                color: #fff !important;
                                            <?php else: ?>
                                                background: #64748b !important;
                                            <?php endif; ?>
                                        ">
                                        <?php echo e($loop->iteration); ?>

                                    </span>
                                </div>
                                <div class="w-[80px] h-[80px] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mr-2 shadow">
                                    <img src="<?php echo e(asset('storage/' . $pop->featured_image)); ?>" alt="<?php echo e($pop->title); ?>" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:1/1; max-width:80px; max-height:80px;" />
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center ml-2">
                                    <h4 class="font-bold text-base md:text-lg text-black leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        <?php echo e(Str::limit($pop->title, 10, '...')); ?>

                                    </h4>
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        <?php echo e($pop->created_at->format('d M Y')); ?>

                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
                                        <span><?php echo e($pop->view_count); ?>x dilihat</span>
                                    </span>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- ICYMI Section -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold text-blue-700 mb-2 tracking-wide">Pernah Terlewat?</div>
                            <?php $__currentLoopData = $icymi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $missed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('artikel.show', $missed->id)); ?>" class="flex flex-row items-start gap-5 bg-white/90 rounded-2xl shadow-2xl border-2 border-blue-200 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-yellow-400/40 no-underline">
                                <!-- Hapus badge angka ranking -->
                                <div class="w-[80px] h-[80px] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mr-2 shadow">
                                    <img src="<?php echo e(asset('storage/' . $missed->featured_image)); ?>" alt="<?php echo e($missed->title); ?>" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:1/1; max-width:80px; max-height:80px;" />
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center ml-2">
                                    <h4 class="font-bold text-base md:text-lg text-black leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        <?php echo e(Str::limit($missed->title, 10, '...')); ?>

                                    </h4>
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        <?php echo e($missed->created_at->format('d M Y')); ?>

                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
                                        <span><?php echo e($missed->view_count); ?>x dilihat</span>
                                    </span>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- Sekat garis antara headline dan berita lainnya -->
                    <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                    <!-- Grid Artikel Semua Genre -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-extrabold text-blue-700 mb-6 mt-8 flex items-center gap-4 justify-start">BERITA LAINNYA</h3>
                        <?php
                            $beritaLainnya = $articles->take(4);
                        ?>
                        <div class="flex flex-col md:flex-row gap-6 mb-8">
                            <?php $__currentLoopData = $beritaLainnya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('artikel.show', $art->id)); ?>" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl no-underline group">
                                    <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                        <img src="<?php echo e(asset('storage/' . $art->featured_image)); ?>" alt="<?php echo e($art->title); ?>" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                    </div>
                                    <div class="flex-1 flex flex-col items-center p-5">
                                        <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-center text-black"
                                            style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
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
                            <?php for($i = $beritaLainnya->count(); $i < 4; $i++): ?>
                                <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
                                    <div class="text-blue-200 text-lg font-semibold">-</div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <!-- Sekat garis antara BERITA LAINNYA dan genre -->
                        <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                        <!-- Berita per Genre -->
                        <?php
                            $allGenres = App\Models\Article::query()->select('genre')->distinct()->pluck('genre');
                        ?>
                        <?php $__currentLoopData = $allGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $genreArticles = $articles->where('genre', $genre)->take(4);
                                // Mapping genre ke slug sesuai controller
                                $genreSlugMap = [
                                    'Bisnis & Tenaga Kerja' => 'bisnis',
                                    'Opini' => 'opini',
                                    'Seni & Budaya' => 'seni',
                                    'Sains' => 'sains',
                                    'Olahraga' => 'olahraga',
                                    'Foto' => 'foto',
                                    'Ilustrasi' => 'ilustrasi',
                                    'Video' => 'video',
                                    'Majalah' => 'majalah',
                                    'Teka-Teki' => 'teka-teki',
                                ];
                                $genreSlug = $genreSlugMap[$genre] ?? Str::slug($genre);
                            ?>
                            <div class="mb-10">
                                <h4 class="text-2xl font-extrabold text-blue-700 mb-4 mt-8 flex items-center gap-2 justify-start"><?php echo e(strtoupper($genre)); ?></h4>
                                <div class="flex flex-col md:flex-row gap-6 mb-4">
                                    <?php $__currentLoopData = $genreArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('artikel.show', $art->id)); ?>" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group">
                                            <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                                <img src="<?php echo e(asset('storage/' . $art->featured_image)); ?>" alt="<?php echo e($art->title); ?>" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                            </div>
                                            <div class="flex-1 flex flex-col items-center p-5">
                                                <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-left"
                                                    style="color: #111 !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; position: relative !important; z-index: 2 !important;">
                                                    <?php echo e(Str::limit($art->title, 10, '...')); ?>

                                                </h4>
                                                <?php if(!empty($art->subheadline)): ?>
                                                <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-center"
                                                    style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                                    <?php echo e(Str::limit($art->subheadline, 10, '...')); ?>

                                                </h5>
                                                <?php endif; ?>
                                                <span class="text-xs mt-2 text-center"
                                                    style="color: #1e40af !important; position: relative !important; z-index: 2 !important;">
                                                    <?php echo e(\Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y')); ?>

                                                </span>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($i = $genreArticles->count(); $i < 4; $i++): ?>
                                        <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
                                            <div class="text-blue-200 text-lg font-semibold">-</div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="flex justify-end">
                                    <a href="<?php echo e(route('dashboard', ['genre' => $genreSlug])); ?>" class="inline-block px-5 py-2 rounded-lg bg-neutral-900 text-white font-semibold shadow hover:bg-blue-900 border-2 border-blue-950 transition">Selengkapnya</a>
                                </div>
                            </div>
                            <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                            <div class="flex justify-center">
                                <?php if($index < count($allGenres) - 1): ?>
                                    <hr class="my-12 border-t-[16px] border-black rounded-full w-[99vw] max-w-none mx-auto shadow-2xl opacity-100" />
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($selectedGenre): ?>
                <div class="flex justify-center mt-8 mb-0 gap-2 w-full" style="margin-top:auto; margin-bottom:0;">
                    <?php if($totalPages > 1): ?>
                        <?php if($page > 1): ?>
                            <a href="?genre=<?php echo e(urlencode($selectedGenre)); ?>&page=<?php echo e($page - 1); ?>" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">&laquo; Sebelumnya</a>
                        <?php endif; ?>
                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?genre=<?php echo e(urlencode($selectedGenre)); ?>&page=<?php echo e($i); ?>"
                               class="px-4 py-2 rounded font-semibold transition select-none text-black bg-transparent"
                               style="border:none; box-shadow:none; opacity:<?php echo e($i == $page ? '1' : '0.5'); ?>;">
                                <?php echo e($i); ?>

                            </a>
                        <?php endfor; ?>
                        <?php if($page < $totalPages): ?>
                            <a href="?genre=<?php echo e(urlencode($selectedGenre)); ?>&page=<?php echo e($page + 1); ?>" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">Selanjutnya &raquo;</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="px-4 py-2 rounded font-semibold select-none text-black bg-transparent border border-blue-200">1</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/dashboard.blade.php ENDPATH**/ ?>