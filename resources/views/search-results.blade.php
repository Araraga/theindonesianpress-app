<x-layouts.app title="Hasil Pencarian">
<div class="min-h-screen flex flex-col">
    <x-header />
    <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <div class="flex-1">
            <h2 class="text-2xl font-extrabold text-red-700 mb-6">Hasil Pencarian: <span class="text-gray-800">{{ request('q') }}</span></h2>
            @if($articles->count())
                @foreach($articles->chunk(4) as $row)
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    @foreach($row as $art)
                        <a href="{{ route('artikel.show', $art->id) }}" class="flex-1 bg-white-900 rounded-2xl shadow-xl flex flex-col items-stretch border-4 border-grey-950 overflow-hidden min-w-[220px] max-w-[900px] h-[340px] cursor-pointer transition hover:scale-[1.025] hover:shadow-2xl group" style="background-color:rgb(255, 255, 255);">
                            <div class="w-full h-[180px] flex items-left justify-left bg-blue-950 overflow-hidden">
                                <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="object-cover w-full h-full max-h-[180px] mx-auto transition-transform duration-300 group-hover:scale-105" style="aspect-ratio:21/9; max-width:900px; max-height:180px;" />
                            </div>
                            <div class="flex-1 flex flex-col items-left p-5">
                                <h4 class="font-bold text-lg md:text-xl mb-1 line-clamp-2 text-left"
                                    style="color: #111 !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                    {{ Str::limit($art->title, 25, '...') }}
                                </h4>
                                @if(!empty($art->subheadline))
                                <h5 class="text-gray-600 text-base line-clamp-2 mb-0 text-left"
                                    style="display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                    {{ Str::limit($art->subheadline, 25, '...') }}
                                </h5>
                                @endif
                                <span class="text-red-700 text-xs mt-2 text-left">{{ \Carbon\Carbon::parse($art->created_at)->translatedFormat('d M Y') }}</span>
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
                <div class="mt-8 flex justify-center">
                    {{ $articles->appends(['q'=>request('q')])->links() }}
                </div>
            @else
                <div class="text-gray-500 text-lg">Tidak ada artikel yang cocok dengan pencarian Anda.</div>
            @endif
        </div>
    </main>
    <x-footer />
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
</x-layouts.app>
