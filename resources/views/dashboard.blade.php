<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen flex flex-col">
        <x-header />
        <!-- Area Konten Dinamis -->
        <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
            <div id="content-beranda" class="flex-1">
                @if($selectedGenre)
                    <div class="mb-10">
                        <h4 class="text-2xl font-extrabold text-blue-700 mb-8 flex items-center gap-2">{{ strtoupper($selectedGenre) }}</h4>
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
                                <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group">
                                    <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                        <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                    </div>
                                    <div class="flex-1 flex flex-col items-center p-5">
                                        <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-center"
                                            style="color: #111 !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                            {{ Str::limit($art->title, 15, '...') }}
                                        </h4>
                                        @if(!empty($art->subheadline))
                                        <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-center"
                                            style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                            {{ Str::limit($art->subheadline, 25, '...') }}
                                        </h5>
                                        @endif
                                        <span class="text-blue-700 text-xs mt-2 text-center">{{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                            @for($i = count($row); $i < 4; $i++)
                                <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
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
                                    <span class="absolute top-0 left-0 w-full text-3xl md:text-4xl font-extrabold py-4 px-0 uppercase tracking-wider text-center bg-red-700 text-white shadow-xl animate-pulse drop-shadow-xl z-20"
                                        style="background: #b91c1c !important; color: #fff !important; border-radius: 0 !important; letter-spacing:0.12em; font-family: 'Playfair Display', 'Merriweather', serif;">
                                        BERITA PALING PANAS MINGGU INI
                                    </span>
                                    @if($headline)
                                        <img id="headline-img" src="{{ asset('storage/' . $headline->featured_image) }}" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    @else
                                        <img id="headline-img" src="{{ asset('images/placeholder-hots.png') }}" alt="Headline" class="w-full h-full transition-transform duration-300 group-hover:scale-105 object-cover" style="min-width:720px; min-height:310px; max-width:720px; max-height:310px; aspect-ratio:720/310; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;" />
                                    @endif
                                    <!-- Tanggal di dalam gambar, pojok kanan bawah -->
                                    <span style="position:absolute; right:0; bottom:0; margin:16px; z-index:10; background: #1e40afcc !important; color: #fff !important; border: 1px solid #2563eb !important;" class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900/90 text-white text-xs font-bold shadow border border-blue-200 font-mono">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        <span class="truncate max-w-[120px]">{{ $headline ? $headline->created_at->format('d M Y') : '-' }}</span>
                                    </span>
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center bg-gradient-to-br from-slate-200 via-blue-200 to-slate-100 shadow-xl border-x-4 border-b-4 border-blue-400 max-w-[720px] mx-auto w-[720px] -mt-1 p-8 gap-2"
                                     style="background: linear-gradient(135deg,rgb(36, 37, 39) 10%,rgb(46, 46, 46) 100%) !important; border-radius: 0 !important;">
                                    <!-- Genre kiri, headline kiri, headline 2 kiri -->
                                    <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-blue-900 text-white text-xs font-semibold shadow border border-white/80 mb-2 font-mono tracking-wide"
                                          style="background: #1e40af !important; color: #fff !important; border: 1px solid #fff !important;">
                                        <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><path d="M4 4h12v12H4z"/><path d="M4 9h12"/></svg>
                                        <span class="truncate max-w-[120px]">{{ $headline?->genre ?? '-' }}</span>
                                    </span>
                                    <h2 class="font-extrabold text-2xl md:text-3xl text-white mb-1 font-serif leading-tight tracking-tight drop-shadow-xl text-left w-full"
                                        style="font-family: 'Playfair Display', 'Merriweather', serif; letter-spacing:0.01em; color: #fff !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($headline?->title ?? 'Judul Headline Utama Minggu Ini', 40, '...') }}
                                    </h2>
                                    @if(!empty($headline?->subheadline))
                                    <h3 class="font-bold text-lg md:text-xl text-blue-200 mb-1 font-serif leading-tight tracking-tight drop-shadow text-left w-full"
                                        style="font-family: 'Playfair Display', 'Merriweather', serif; letter-spacing:0.01em; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($headline?->subheadline, 60, '...') }}
                                    </h3>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <!-- Top 3 Populer Mini: 3 Berita Terpopuler Minggu Ini (tinggi card lebih besar dan lebih naik ke atas) -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold text-blue-700 mb-2 tracking-wide">Paling Populer</div>
                            @foreach($top3 as $pop)
                            <a href="{{ route('artikel.show', $pop->id) }}" class="flex flex-row items-start gap-5 bg-white/90 rounded-2xl shadow-2xl border-2 border-blue-200 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-blue-400/40 no-underline">
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
                                    <h4 class="font-bold text-base md:text-lg text-black leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($pop->title, 10, '...') }}
                                    </h4>
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        {{ $pop->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
                                        <span>{{ $pop->view_count }}x dilihat</span>
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <!-- ICYMI Section -->
                        <div class="flex-[2] flex flex-col gap-6 max-w-[320px] self-stretch justify-start mt-[-40px]">
                            <div class="text-center text-2xl font-extrabold text-blue-700 mb-2 tracking-wide">Pernah Terlewat?</div>
                            @foreach($icymi as $missed)
                            <a href="{{ route('artikel.show', $missed->id) }}" class="flex flex-row items-start gap-5 bg-white/90 rounded-2xl shadow-2xl border-2 border-blue-200 p-4 min-h-[140px] h-[140px] max-h-[140px] relative group transition-transform duration-300 hover:scale-[1.03] hover:shadow-yellow-400/40 no-underline">
                                <!-- Hapus badge angka ranking -->
                                <div class="w-[80px] h-[80px] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mr-2 shadow">
                                    <img src="{{ asset('storage/' . $missed->featured_image) }}" alt="{{ $missed->title }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:1/1; max-width:80px; max-height:80px;" />
                                </div>
                                <div class="flex-1 flex flex-col items-start justify-center ml-2">
                                    <h4 class="font-bold text-base md:text-lg text-black leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition" style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        {{ Str::limit($missed->title, 10, '...') }}
                                    </h4>
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><rect x="3" y="4" width="14" height="12" rx="2"/><path d="M8 2v4m4-4v4M3 10h14"/></svg>
                                        {{ $missed->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19c-5 0-9-2-9-5V7c0-3 4-5 9-5s9 2 9 5v7c0 3-4 5-9 5z"/><circle cx="12" cy="13" r="3"/></svg>
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
                        <h3 class="text-2xl font-extrabold text-blue-700 mb-6 mt-8 flex items-center gap-4 justify-start">BERITA LAINNYA</h3>
                        @php
                            $beritaLainnya = $articles->take(4);
                        @endphp
                        <div class="flex flex-col md:flex-row gap-6 mb-8">
                            @foreach($beritaLainnya as $art)
                                <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl no-underline group">
                                    <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                        <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                    </div>
                                    <div class="flex-1 flex flex-col items-center p-5">
                                        <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-center text-black"
                                            style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                            {{ Str::limit($art->title, 15, '...') }}
                                        </h4>
                                        @if(!empty($art->subheadline))
                                        <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-center"
                                            style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                            {{ Str::limit($art->subheadline, 25, '...') }}
                                        </h5>
                                        @endif
                                        <span class="text-blue-700 text-xs mt-2 text-center">{{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                            @for($i = $beritaLainnya->count(); $i < 4; $i++)
                                <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
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
                                <h4 class="text-2xl font-extrabold text-blue-700 mb-4 mt-8 flex items-center gap-2 justify-start">{{ strtoupper($genre) }}</h4>
                                <div class="flex flex-col md:flex-row gap-6 mb-4">
                                    @foreach($genreArticles as $art)
                                        <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 bg-blue-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-blue-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group">
                                            <div class="w-full h-[180px] flex items-center justify-center bg-blue-950 overflow-hidden">
                                                <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                                            </div>
                                            <div class="flex-1 flex flex-col items-center p-5">
                                                <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-left"
                                                    style="color: #111 !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important; position: relative !important; z-index: 2 !important;">
                                                    {{ Str::limit($art->title, 10, '...') }}
                                                </h4>
                                                @if(!empty($art->subheadline))
                                                <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-center"
                                                    style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                                    {{ Str::limit($art->subheadline, 10, '...') }}
                                                </h5>
                                                @endif
                                                <span class="text-xs mt-2 text-center"
                                                    style="color: #1e40af !important; position: relative !important; z-index: 2 !important;">
                                                    {{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                    @for($i = $genreArticles->count(); $i < 4; $i++)
                                        <div class="flex-1 bg-blue-50 rounded-2xl border-4 border-blue-100 min-w-[220px] max-w-[900px] h-[340px] flex items-center justify-center">
                                            <div class="text-blue-200 text-lg font-semibold">-</div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('dashboard', ['genre' => $genreSlug]) }}" class="inline-block px-5 py-2 rounded-lg bg-neutral-900 text-white font-semibold shadow hover:bg-blue-900 border-2 border-blue-950 transition">Selengkapnya</a>
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
                <div class="flex justify-center mt-8 mb-0 gap-2 w-full" style="margin-top:auto; margin-bottom:0;">
                    @if($totalPages > 1)
                        @if($page > 1)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $page - 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">&laquo; Sebelumnya</a>
                        @endif
                        @for($i = 1; $i <= $totalPages; $i++)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $i }}"
                               class="px-4 py-2 rounded font-semibold transition select-none text-black bg-transparent"
                               style="border:none; box-shadow:none; opacity:{{ $i == $page ? '1' : '0.5' }};">
                                {{ $i }}
                            </a>
                        @endfor
                        @if($page < $totalPages)
                            <a href="?genre={{ urlencode($selectedGenre) }}&page={{ $page + 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">Selanjutnya &raquo;</a>
                        @endif
                    @else
                        <span class="px-4 py-2 rounded font-semibold select-none text-black bg-transparent border border-blue-200">1</span>
                    @endif
                </div>
            @endif
        </main>
        <x-footer />
    </div>
    {{-- Script JS dihapus, gunakan hanya dari <x-header /> agar tidak bentrok --}}
</x-layouts.app>
