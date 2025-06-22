<x-layouts.app>
    <div class="min-h-screen flex flex-col bg-white">
        <x-header />

        <main class="flex-1 flex flex-row justify-center py-8 px-4 gap-8 bg-white">
            <!-- Artikel Utama -->
            <div class="w-full max-w-3xl bg-white">
                <!-- Gambar Utama -->
                <div class="w-full h-[320px] md:h-[400px] overflow-hidden flex items-center justify-center bg-gray-100 border-b border-gray-200 mt-6">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="object-cover w-full h-full max-h-[400px] mx-auto rounded-2xl" style="aspect-ratio:21/9;" />
                </div>

                <!-- Judul & Subheadline -->
                <div class="px-0 pt-24 pb-2 bg-white" style="padding-top:2rem !important;">
                    <h1 class="font-extrabold text-gray-900 mb-4 leading-tight font-serif text-3xl md:text-4xl lg:text-5xl text-left"
                        style="font-size:2.2rem; line-height:1.15;">
                        {{ $article->title }}
                    </h1>
                    @if($article->subheadline)
                        <h2 class="text-2xl md:text-3xl text-gray-700 mb-4 font-serif">{{ $article->subheadline }}</h2>
                    @endif

                    @if(auth()->check() && auth()->id() === $article->user_id)
                        <div class="flex gap-3 mb-4">
                            <a href="{{ route('artikel.edit', $article->id) }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-bold shadow transition text-base" style="min-width:140px; justify-content:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z" />
                                </svg>
                                Edit Artikel
                            </a>
                            <form method="POST" action="{{ route('artikel.destroy', $article->id) }}" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg font-bold shadow transition text-base" style="background:#dc2626 !important; color:#fff !important; border:2px solid #991b1b !important; min-width:140px; justify-content:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Hapus Artikel
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-xs font-semibold shadow font-mono tracking-wide"
                            style="background:#1e40af !important; color:#fff !important; border:2px solid #ffb300 !important;">
                            {{ $article->category->name ?? '-' }}
                        </span>
                        <span class="text-gray-500 text-sm">Oleh <span class="font-bold text-gray-800">{{ $article->user->name ?? 'Anonim' }}</span></span>
                        <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') }}</span>
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                <path d="M12 17c-4.418 0-8-1.79-8-4V7c0-2.21 3.582-4 8-4s8 1.79 8 4v6c0 2.21-3.582 4-8 4z"/>
                                <circle cx="12" cy="11" r="3"/>
                            </svg>
                            <span>{{ $article->view_count }}x dilihat</span>
                        </span>
                    </div>

                    <hr class="my-6 border-t-2 border-gray-200" />
                </div>

                <!-- Isi Artikel -->
                <div class="px-0 pb-12 text-lg md:text-xl text-gray-900 leading-relaxed font-sans bg-white">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <hr class="my-8 border-t-2 border-gray-200" />

                <!-- Like/Bookmark -->
                @livewire('article-actions', ['articleId' => $article->id])

                <!-- Komentar -->
                <div class="bg-blue-50 rounded-xl p-6 mb-12 mx-auto" style="background:#e0e7ff !important;">
                    <div class="max-w-3xl mx-auto">
                        <h3 class="font-bold text-lg mb-4" style="color:#1e40af !important;">Diskusi & Komentar</h3>
                        @livewire('comment-section', ['articleId' => $article->id])
                    </div>
                </div>
            </div>

            <!-- Rekomendasi Berita -->
            <div class="hidden lg:block flex-shrink-0 w-[400px]">
                <div class="text-left text-2xl font-extrabold mb-4 tracking-wide"
                    style="color:#7E2320 !important;">
                    Rekomendasi Berita
                </div>
                <div class="flex flex-col gap-4">
                    @foreach($icymi as $missed)
                        <a href="{{ route('artikel.show', $missed->id) }}" class="flex flex-row items-start gap-3 rounded-2xl shadow-lg border p-3 h-[120px] group hover:scale-[1.03] transition-transform no-underline">
                            <div class="w-[80px] h-[80px] rounded-lg overflow-hidden shadow bg-gray-100">
                                <img src="{{ asset('storage/' . $missed->featured_image) }}" alt="{{ $missed->title }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform" />
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-yellow-200">{{ $missed->category?->name }}</span>
                                <h4 class="text-sm font-semibold text-black leading-snug mt-1 line-clamp-2">{{ $missed->title }}</h4>
                                <span class="text-[10px] text-yellow-100 mt-1">{{ $missed->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </main>

        <x-footer />
    </div>
</x-layouts.app>
