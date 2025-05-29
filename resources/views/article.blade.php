{{-- resources/views/article.blade.php --}}
<x-layouts.app>
    <div class="min-h-screen flex flex-col bg-white">
        <x-header />
        <main class="flex-1 flex flex-col items-center justify-center py-0 px-0 bg-white">
            <div class="w-full max-w-3xl mx-auto p-0 md:p-0 mt-0 bg-white"> <!-- kembali ke max-w-3xl agar tidak terlalu lebar -->
                <!-- Gambar Utama -->
                <div class="w-full max-w-4xl mx-auto h-[320px] md:h-[400px] overflow-hidden flex items-center justify-center bg-gray-100 border-b border-gray-200 mt-6"> <!-- mt-6: jarak atas gambar ke navbar -->
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="object-cover w-full h-full max-h-[400px] mx-auto rounded-2xl" style="aspect-ratio:21/9; max-width:100%; max-height:400px;" />
                </div>
                <!-- Judul & Subheadline -->
                <div class="px-0 pt-24 pb-2 bg-white" style="padding-top:2rem !important;"> <!-- padding-top diperbesar agar jarak headline ke gambar lebih lega -->
                    <h1 class="font-extrabold text-gray-900 mb-4 leading-tight font-serif text-3xl md:text-4xl lg:text-5xl text-balance break-words text-left"
                        style="font-size:2.2rem; max-width:100%; word-break:break-word; white-space:normal; line-height:1.15;">
                        {{ $article->title }}
                    </h1>
                    @if($article->subheadline)
                        <h2 class="text-2xl md:text-3xl text-gray-700 mb-4 font-serif">{{ $article->subheadline }}</h2>
                    @endif
                    @if(auth()->check() && auth()->id() === $article->user_id)
                        <div class="flex gap-3 mb-4">
                            <a href="{{ route('artikel.edit', $article->id) }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-bold shadow transition text-base" style="min-width:140px; justify-content:center;"> 
                                <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z' /></svg>
                                Edit Artikel
                            </a>
                            <form method="POST" action="{{ route('artikel.destroy', $article->id) }}" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" class="inline-block" style="min-width:140px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg font-bold shadow transition text-base" style="background:#dc2626 !important; color:#fff !important; border:2px solid #991b1b !important; min-width:140px; justify-content:center;">
                                    <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>
                                    Hapus Artikel
                                </button>
                            </form>
                        </div>
                    @endif
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-xs font-semibold shadow font-mono tracking-wide"
                              style="background:#1e40af !important; color:#fff !important; border:2px solid #ffb300 !important;">
                            {{ $article->genre }}
                        </span>
                        <span class="text-gray-500 text-sm">Oleh <span class="font-bold text-gray-800">{{ $article->user->name ?? 'Anonim' }}</span></span>
                        <span class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') }}</span>
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20"><path d="M12 17c-4.418 0-8-1.79-8-4V7c0-2.21 3.582-4 8-4s8 1.79 8 4v6c0 2.21-3.582 4-8 4z"/><circle cx="12" cy="11" r="3"/></svg>
                            <span>{{ $article->view_count }}x dilihat</span>
                        </span>
                    </div>
                    <hr class="my-6 border-t-2 border-gray-200" />
                </div>
                <div class="px-0 pb-12 text-lg md:text-xl text-gray-900 leading-relaxed font-sans bg-white"> <!-- px-8 agar isi artikel tetap rapi -->
                    {!! nl2br(e($article->content)) !!}
                </div>
                <hr class="my-8 border-t-2 border-gray-200" />
                <!-- Tombol Like/Dislike Responsive -->
                <div class="flex items-center gap-6 mt-10 mb-8 px-2 justify-center">
                    <form method="POST" action="{{ route('artikel.like', $article->id) }}" class="like-form" onsubmit="event.preventDefault(); fetchLike(this);">
                        @csrf
                        <button type="submit" id="like-btn" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition transform hover:scale-105 active:scale-95 focus:ring-2 focus:outline-none duration-150"
                            style="background:#bbf7d0 !important; color:#166534 !important; border:2px solid #22c55e !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#166534 !important;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-6 0v4H5a2 2 0 00-2 2v7a2 2 0 002 2h14a2 2 0 002-2v-7a2 2 0 00-2-2h-3z" /></svg>
                            <span class="like-label">Like (<span id="like-count">{{ $article->likes->count() }}</span>)</span>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('artikel.dislike', $article->id) }}" class="dislike-form" onsubmit="event.preventDefault(); fetchDislike(this);">
                        @csrf
                        <button type="submit" id="dislike-btn" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition transform hover:scale-105 active:scale-95 focus:ring-2 focus:outline-none duration-150"
                            style="background:#fee2e2 !important; color:#b91c1c !important; border:2px solid #ef4444 !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#b91c1c !important;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 15v4a3 3 0 006 0v-4h3a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2h3z" /></svg>
                            <span class="dislike-label">Dislike</span>
                        </button>
                    </form>
                </div>
                <!-- Tombol Bookmark Responsive -->
                <div class="flex items-center gap-6 mt-2 mb-8 px-2 justify-center">
                    @auth
                        @php $bookmarked = $article->bookmarks()->where('user_id', auth()->id())->exists(); @endphp
                        <form method="POST" action="{{ $bookmarked ? route('artikel.unbookmark', $article->id) : route('artikel.bookmark', $article->id) }}" class="bookmark-form" onsubmit="event.preventDefault(); fetchBookmark(this);">
                            @csrf
                            <button type="submit" id="bookmark-btn" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition transform hover:scale-105 active:scale-95 focus:ring-2 focus:outline-none duration-150"
                                style="background:#fef9c3 !important; color:#b45309 !important; border:2px solid #f59e42 !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#b45309 !important;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                </svg>
                                <span class="bookmark-label">{{ $bookmarked ? 'Tersimpan' : 'Bookmark' }}</span>
                            </button>
                        </form>
                    @endauth
                </div>
                <!-- Kolom Diskusi/Komentar Responsive -->
                <div class="bg-blue-50 rounded-xl p-6 mb-12 mx-auto" style="background:#e0e7ff !important; max-width:100%; width:100%; margin-bottom:2em !important;">
                    <div class="max-w-3xl mx-auto">
                        <h3 class="font-bold text-lg mb-4" style="color:#1e40af !important;">Diskusi & Komentar</h3>
                        @auth
                        <form method="POST" action="{{ route('artikel.comment', $article->id) }}" class="mb-6 comment-form" onsubmit="event.preventDefault(); submitComment(this);">
                            @csrf
                            <textarea name="content" rows="3" class="w-full rounded-lg border-2 px-4 py-3 text-base focus:ring-2 outline-none resize-none mb-2"
                                style="background:#f0f6ff !important; color:#1e40af !important; border-color:#1e40af !important;" placeholder="Tulis komentar..." required></textarea>
                            <button type="submit" class="px-6 py-2 rounded-lg font-bold shadow transition transform hover:scale-105 active:scale-95 focus:ring-2 focus:outline-none duration-150"
                                style="background:#1e40af !important; color:#fff !important;">Kirim</button>
                        </form>
                        <div class="space-y-4" id="comments-list">
                            @forelse($article->comments()->whereNull('parent_id')->where('is_approved', true)->latest()->get() as $comment)
                                <div class="bg-white rounded-lg border p-4" style="border-color:#1e40af !important;" id="comment-{{ $comment->id }}">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-bold" style="color:#1e40af !important;">{{ $comment->user->name ?? 'Anonim' }}</span>
                                        <span class="text-xs" style="color:#64748b !important;">{{ $comment->created_at->diffForHumans() }}</span>
                                        @if(auth()->check() && $comment->user_id === auth()->id())
                                            <button onclick="editComment({{ $comment->id }}, '{{ addslashes($comment->content) }}')" class="ml-2 px-2 py-1 rounded text-xs font-bold bg-yellow-100 hover:bg-yellow-200 text-yellow-800 transition">Edit</button>
                                        @endif
                                    </div>
                                    <div class="text-gray-800" style="color:#1e293b !important;" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</div>
                                </div>
                            @empty
                                <div class="text-gray-500" style="color:#64748b !important;">Belum ada komentar. Jadilah yang pertama!</div>
                            @endforelse
                        </div>
                        @else
                        <div class="mb-4" style="color:#1e40af !important;">Silakan <a href="{{ route('login') }}" class="underline font-bold" style="color:#1e40af !important;">login</a> untuk ikut berdiskusi.</div>
                        @endauth
                    </div>
                </div>
                <!-- END Komentar -->
            </div>
        </main>
        <x-footer />
    </div>
</x-layouts.app>
<script>
function fetchLike(form) {
    const btn = document.getElementById('like-btn');
    btn.disabled = true;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('like-count').innerText = data.likes;
        btn.disabled = false;
    });
}
function fetchDislike(form) {
    const btn = document.getElementById('dislike-btn');
    btn.disabled = true;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('like-count').innerText = data.likes;
        btn.disabled = false;
    });
}
function fetchBookmark(form) {
    const btn = document.getElementById('bookmark-btn');
    btn.disabled = true;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.bookmarked) {
            btn.querySelector('.bookmark-label').innerText = 'Tersimpan';
            form.action = form.action.replace('bookmark', 'unbookmark');
        } else {
            btn.querySelector('.bookmark-label').innerText = 'Bookmark';
            form.action = form.action.replace('unbookmark', 'bookmark');
        }
        btn.disabled = false;
    });
}
function submitComment(form) {
    const btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(new FormData(form)),
    })
    .then(res => res.ok ? res.json() : res.text())
    .then(data => {
        if (typeof data === 'object' && data.commentHtml) {
            document.getElementById('comments-list').insertAdjacentHTML('afterbegin', data.commentHtml);
            form.reset();
        }
        btn.disabled = false;
    });
}
function editComment(id, content) {
    const commentDiv = document.getElementById('comment-' + id);
    const contentDiv = document.getElementById('comment-content-' + id);
    // Escape double quotes and backslashes for HTML attribute
    const safeContent = content.replace(/&/g, '&amp;').replace(/'/g, '&#39;').replace(/"/g, '&quot;');
    contentDiv.innerHTML = `<form onsubmit=\"event.preventDefault();submitEditComment(this,${id});\"><textarea name='content' rows='2' class='w-full rounded-lg border-2 px-3 py-2 text-base focus:ring-2 outline-none resize-none mb-2' style='background:#f0f6ff !important; color:#1e40af !important; border-color:#1e40af !important;'>${safeContent}</textarea><button type='submit' class='px-4 py-1 rounded-lg font-bold shadow transition bg-yellow-500 text-white hover:bg-yellow-600 text-sm'>Simpan</button></form>`;
}
function submitEditComment(form, id) {
    const btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    fetch(`/artikel/comment/${id}/edit`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('[name=_token]') ? document.querySelector('[name=_token]').value : document.querySelector('meta[name=csrf-token]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(new FormData(form)),
    })
    .then(res => res.ok ? res.json() : res.text())
    .then(data => {
        if (typeof data === 'object' && data.content) {
            document.getElementById('comment-content' + id).innerText = data.content;
        }
        btn.disabled = false;
    });
}
</script>
