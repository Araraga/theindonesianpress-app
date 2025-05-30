<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen flex flex-col">
        <x-header />
        <!-- Area Konten Dinamis -->
        <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
            <div id="content-beranda" class="flex-1">
                @if($selectedGenre)
                    <div class="mb-10">
                        <h4 class="text-2xl font-extrabold mb-8 flex items-center gap-2" style="color: #7E2320;">{{ strtoupper($selectedGenre) }}</h4>
                        @php
                            $perPage = 12;
                            $page = request()->get('page', 1);
                            $total = $articles->count();
                            $totalPages = ceil($total / $perPage);
                            $currentArticles = $articles->forPage($page, $perPage)->values();
                        @endphp
                        @foreach($currentArticles->chunk(4) as $row)
                        <div class="flex flex-col md:flex-row gap-6 mb-8">
                            @foreach($row as $art)
                                <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 rounded-2xl shadow-xl flex flex-col items-stretch border-4 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl no-underline group" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                    <div class="w-full h-[180px] flex items-center justify-center overflow-hidden" style="background: #171717f7 !important;">
                                        <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                    </div>
                                    <div class="flex-1 flex flex-col items-start p-5 mb-8" style="padding-left: 1rem !important;">
                                        <h4 class="font-bold text-lg md:text-xl mb-1 mt-4 line-clamp-2 text-left" style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                            {{ Str::limit($art->title, 20, '...') }}
                                        </h4>
                                        @if(!empty($art->subheadline))
                                        <h5 class="text-base line-clamp-2 mb-0 text-left" style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                            {{ Str::limit($art->subheadline, 30, '...') }}
                                        </h5>
                                        @endif
                                        <span class="text-xs mt-2 text-left" style="color: #FFF6BE !important;">
                                            {{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                            @for($i = count($row); $i < 4; $i++)
                                <div class="flex-1 rounded-2xl flex items-center justify-center border-4 min-w-[220px] max-w-[900px] h-[340px]" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                    <div class="text-blue-200 text-lg font-semibold">-</div>
                                </div>
                            @endfor
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Headline / Berita Hots & Top 3 Populer Minggu Ini -->
                    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-center items-start">
                        <!-- Headline Besar: Label di atas gambar, info di bawah gambar, label lebih besar, gap lebih lebar, rata kiri -->
                        <div class="flex-[10] relative bg-gradient-to-br from-red-700 via-yellow-100 to-blue-700/80 rounded-2xl shadow-2xl flex flex-col items-stretch justify-between min-w-[320px] max-w-[900px] border-4 border-blue-400 overflow-hidden">
                            <a href="{{ $headline ? route('artikel.show', $headline->id) : '#' }}" class="block w-full h-full no-underline text-inherit group">
                                <div class="relative w-[720px] h-[310px] max-w-full mx-auto flex items-center justify-center bg-blue-100/60 backdrop-blur-xl overflow-hidden border-4 border-blue-400 shadow-xl" style="border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;">
                                    <span class="absolute top-0 left-0 w-full text-3xl md:text-4xl font-extrabold p-4 px-0 uppercase tracking-wider text-center shadow-xl animate-pulse drop-shadow-xl z-20"
                                        style="background: #7E2320 !important; color: #FFF6BE !important; border-radius: 0 !important; letter-spacing:0.12em; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; border: 2px solid #7E2320;">
                                        BERITA PALING PANAS MINGGU INI
                                    </span>
                                    @if($headline)
                                        <img id="headline-img" src="{{ asset('storage/' . $headline->featured_image) }}" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    @else
                                        <img id="headline-img" src="{{ asset('images/placeholder-hots.png') }}" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    @endif
                                    <!-- Tanggal di dalam gambar, pojok kanan bawah -->
                                    <span style="position:absolute; right:0; bottom:0; margin:16px; z-index:10; background: #7e2320ba !important; color: #fefefe !important; border: 1px solid #7e2320ba !important; border-radius: 9999px !important; padding: 0.25rem 0.75rem !important; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; font-weight: bold; box-shadow: 0 2px 8px #7E232033;" class="shadow font-mono">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        <span class="truncate max-w-[120px]">{{ $headline ? $headline->created_at->format('d M Y') : '-' }}</span>
                                    </span>
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center shadow-xl border-x-4 border-b-4 border-blue-400 max-w-[720px] mx-auto w-[720px] -mt-1 p-8 gap-2" style="background: #171717f7 !important; border-radius: 0 !important;">
                                    <!-- Genre kiri, headline kiri, headline 2 kiri -->
                                    <span class="text-lg font-semibold mb-1 underline" style="color:#FFF6BE;">{{ $headline?->genre ?? '-' }}</span>
                                    <h2 class="font-extrabold text-2xl md:text-3xl text-white mb-1 mt-4 font-serif leading-tight tracking-tight drop-shadow-xl text-left w-full"
                                        style="font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; letter-spacing:0.01em; color: #fff !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($headline?->title ?? 'Judul Headline Utama Minggu Ini', 50, '...') }}
                                    </h2>
                                    @if(!empty($headline?->subheadline))
                                    <h3 class="font-normal text-lg md:text-xl text-blue-200 mb-1 font-serif leading-tight tracking-tight drop-shadow text-left w-full"
                                        style="font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; letter-spacing:0.01em; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($headline?->subheadline, 65, '...') }}
                                    </h3>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <!-- Top 3 Populer Mini: 3 Berita Terpopuler Minggu Ini (tinggi card lebih besar dan lebih naik ke atas) -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold mb-2 tracking-wide"
                                 style="color:#FFF6BE !important; background:#7E2320 !important; border-radius:1rem; border:2px solid #7E2320; padding:0.5rem 0; box-shadow:0 2px 8px #7E232033;">
                                Paling Populer
                            </div>
                            @foreach($top3 as $pop)
                            <a href="{{ route('artikel.show', $pop->id) }}" class="flex flex-row items-start gap-5 rounded-2xl shadow-2xl border-2 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-blue-400/40 no-underline" style="background:#171717f7 !important; border-width:2px !important;">
                                <div class="absolute -left-4 top-1/2 -translate-y-1/2 z-10">
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full text-white text-xl font-black shadow-lg border-2 border-white/80 animate-bounce"
                                        style="
                                            @if($loop->iteration == 1)
                                                background: linear-gradient(135deg, #f59e42 0%, #eab308 100%) !important;
                                                color: #fff !important;
                                            @elseif($loop->iteration == 2)
                                                background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important;
                                                color: #fff !important;
                                            @elseif($loop->iteration == 3)
                                                background: linear-gradient(135deg, #38bdf8 0%, #1e40af 100%) !important;
                                                color: #fff !important;
                                            @else
                                                background: #64748b !important;
                                            @endif
                                        ">
                                        {{ $loop->iteration }}
                                    </span>
                                </div>
                                <div class="w-[80px] h-[80px] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mr-2 shadow">
                                    <img src="{{ asset('storage/' . $pop->featured_image) }}" alt="{{ $pop->title }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:1/1; max-width:80px; max-height:80px;" />
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center ml-2">
                                    <h4 class="font-bold text-base md:text-lg leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="color:#FEFEFE !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                        {{ Str::limit($pop->title, 10, '...') }}
                                    </h4>
                                    <span class="text-xs flex items-center gap-1" style="color:#FFF6BE !important;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20" style="color:#FFF6BE !important;"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        {{ $pop->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs flex items-center gap-1 mt-1" style="color:#FFF6BE !important;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#FFF6BE !important;"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
                                        <span>{{ $pop->view_count }}x dilihat</span>
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <!-- ICYMI Section -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold mb-2 tracking-wide"
                                 style="color:#FFF6BE !important; background:#7E2320 !important; border-radius:1rem; border:2px solid #7E2320; padding:0.5rem 0; box-shadow:0 2px 8px #7E232033;">
                                Pernah Terlewat?
                            </div>
                            @foreach($icymi as $missed)
                            <a href="{{ route('artikel.show', $missed->id) }}" class="flex flex-row items-start gap-5 rounded-2xl shadow-2xl border-2 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-yellow-400/40 no-underline" style="background:#171717f7 !important; border-width:2px !important;">
                                <!-- Hapus badge angka ranking -->
                                <div class="w-[80px] h-[80px] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mr-2 shadow">
                                    <img src="{{ asset('storage/' . $missed->featured_image) }}" alt="{{ $missed->title }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:1/1; max-width:80px; max-height:80px;" />
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center ml-2">
                                    <h4 class="font-bold text-base md:text-lg leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="color:#FEFEFE !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                        {{ Str::limit($missed->title, 10, '...') }}
                                    </h4>
                                    <span class="text-xs flex items-center gap-1" style="color:#FFF6BE !important;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20" style="color:#FFF6BE !important;"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        {{ $missed->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs flex items-center gap-1 mt-1" style="color:#FFF6BE !important;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#FFF6BE !important;"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
                                        <span>{{ $missed->view_count }}x dilihat</span>
                                    </span>
                                </div>
                            </a>
                            @endforeach                             
                        </div>
                    </div>
                    <!-- Sekat garis antara headline dan berita lainnya -->
                    <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                    <!-- Grid Artikel Semua Genre -->
                    <div class="space-y-6">
                        <h3 class="text-2xl font-extrabold mb-6 mt-8 flex items-center gap-4 justify-start" style="color: #7E2320;">BERITA LAINNYA</h3>
                        @php
                            $beritaLainnya = $articles->take(4);
                        @endphp
                        <div class="flex flex-col md:flex-row gap-6 mb-16" style="margin-bottom: 4rem !important;">
                            @foreach($beritaLainnya as $art)
                                <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 rounded-2xl shadow-xl flex flex-col items-stretch border-4 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl no-underline group" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                    <div class="w-full h-[180px] flex items-center justify-center overflow-hidden" style="background: #171717f7 !important;">
                                        <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                    </div>
                                    <div class="flex-1 flex flex-col items-start p-5 mb-8" style="padding-left: 1rem !important;">
                                        <h4 class="font-bold text-lg md:text-xl mb-1 mt-4 line-clamp-2 text-left" style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                            {{ Str::limit($art->title, 20, '...') }}
                                        </h4>
                                        @if(!empty($art->subheadline))
                                        <h5 class="text-base line-clamp-2 mb-0 text-left" style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                            {{ Str::limit($art->subheadline, 30, '...') }}
                                        </h5>
                                        @endif
                                        <span class="text-xs mt-2 text-left" style="color: #FFF6BE !important;">
                                            {{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                            @for($i = $beritaLainnya->count(); $i < 4; $i++)
                                <div class="flex-1 rounded-2xl flex items-center justify-center border-4 min-w-[220px] max-w-[900px] h-[340px]" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                    <div class="text-blue-200 text-lg font-semibold">-</div>
                                </div>
                            @endfor
                        </div>
                        <!-- Sekat garis antara BERITA LAINNYA dan genre -->
                        <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                        <!-- Berita per Genre -->
                        @php
                            $allGenres = App\Models\Article::query()->select('genre')->distinct()->pluck('genre');
                        @endphp
                        @foreach($allGenres as $index => $genre)
                            @php
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
                            @endphp
                            <div class="mb-10">
                                <h4 class="text-2xl font-extrabold mb-4 mt-8 flex items-center gap-2 justify-start" style="color: #7E2320;">{{ strtoupper($genre) }}</h4>
                                <div class="flex flex-col md:flex-row gap-6 mb-4">
                                    @foreach($genreArticles as $art)
                                        <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 rounded-2xl shadow-xl flex flex-col items-stretch border-4 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                            <div class="w-full h-[180px] flex items-center justify-center overflow-hidden" style="background: #171717f7 !important;">
                                                <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                            </div>
                                            <div class="flex-1 flex flex-col items-start p-5 mb-8" style="padding-left: 1rem !important;">
                                                <h4 class="font-bold text-lg md:text-xl mb-1 mt-4 line-clamp-2 text-left"
                                                    style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; position: relative !important; z-index: 2 !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                                    {{ Str::limit($art->title, 20, '...') }}
                                                </h4>
                                                @if(!empty($art->subheadline))
                                                <h5 class="text-base line-clamp-2 mb-0 text-left"
                                                    style="color: #fefefe !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;">
                                                    {{ Str::limit($art->subheadline, 30, '...') }}
                                                </h5>
                                                @endif
                                                <span class="text-xs mt-2 text-left"
                                                    style="color: #FFF6BE !important; position: relative !important; z-index: 2 !important;">
                                                    {{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                    @for($i = $genreArticles->count(); $i < 4; $i++)
                                        <div class="flex-1 rounded-2xl flex items-center justify-center border-4 min-w-[220px] max-w-[900px] h-[340px]" style="background: #171717f7 !important; border-color: #171717f7 !important;">
                                            <div class="text-blue-200 text-lg font-semibold">-</div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('dashboard', ['genre' => $genreSlug]) }}" class="inline-block px-5 py-2 rounded-lg font-semibold shadow border-2 transition" style="background: #7E2320; color: #FFF6BE; border-color: #7E2320;">Selengkapnya</a>
                                </div>
                            </div>
                            <hr class="my-12 border-t-8 border-black rounded-full w-[98vw] max-w-none mx-auto shadow-lg opacity-100" />
                            <div class="flex justify-center">
                                @if($index < count($allGenres) - 1)
                                    <hr class="my-12 border-t-[16px] border-black rounded-full w-[99vw] max-w-none mx-auto shadow-2xl opacity-100" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($selectedGenre)
                @if($totalPages > 1)
                    <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                        @if($page > 1)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $page - 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">&laquo; Sebelumnya</a>
                        @endif
                        @for($i = 1; $i <= $totalPages; $i++)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $i }}"
                               class="px-4 py-2 rounded font-semibold transition select-none text-black bg-transparent {{ $i == $page ? 'bg-yellow-200 text-yellow-900 font-bold border border-yellow-400' : '' }}"
                               style="border:none; box-shadow:none; opacity:{{ $i == $page ? '1' : '0.5' }};">
                                {{ $i }}
                            </a>
                        @endfor
                        @if($page < $totalPages)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $page + 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">Selanjutnya &raquo;</a>
                        @endif
                    </div>
                @else
                    <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                        <span class="px-4 py-2 rounded font-semibold select-none text-black bg-transparent border border-yellow-200" style="opacity:1;">1</span>
                    </div>
                @endif
            @endif
        </main>
        <x-footer />
    </div>
    {{-- Script JS dihapus, gunakan hanya dari <x-header /> agar tidak bentrok --}}
</x-layouts.app>
