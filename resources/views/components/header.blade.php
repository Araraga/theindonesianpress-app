<div class="w-full bg-white border-b border-neutral-200">
    <div class="container mx-auto flex flex-row items-center justify-center py-8 px-1 gap-1 relative">
        <span class="font-extrabold text-3xl md:text-4xl text-blue-700 tracking-widest drop-shadow text-center w-full font-serif" style="letter-spacing:0.15em; font-family: 'Playfair Display', 'Merriweather', serif;">The Indonesian Press</span>
        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center gap-3">
            <form id="search-form" class="relative" action="{{ route('search.results') }}" method="get" autocomplete="off">
                <input name="q" id="search-input" type="text" placeholder="Cari berita..." class="w-64 px-4 py-2 rounded-lg border border-neutral-300 bg-gray-50 text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none text-base" autocomplete="off" value="{{ request('q') }}" />
                <ul id="search-autocomplete-results" class="absolute left-0 mt-1 w-full bg-white border border-blue-200 rounded-lg shadow-lg z-50 hidden"></ul>
            </form>
        </div>
    </div>
</div>
<nav class="w-full bg-white/90 border-b border-neutral-200 shadow z-50 sticky top-0 backdrop-blur" style="z-index:9999 !important;">
    <div class="w-full max-w-[900px] mx-auto flex flex-wrap justify-center py-3 px-4 gap-2 md:gap-4 z-0 relative">
        <ul class="flex flex-wrap justify-center gap-2 md:gap-4 text-sm font-semibold text-gray-800 items-center">
            <li><a href="{{ route('dashboard') }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition">Beranda</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'bisnis']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="bisnis">Bisnis & Tenaga Kerja</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'opini']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="opini">Opini</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'seni']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="seni">Seni & Budaya</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'sains']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="sains">Sains</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'olahraga']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="olahraga">Olahraga</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'foto']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="foto">Foto</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'ilustrasi']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="ilustrasi">Ilustrasi</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'video']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="video">Video</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'majalah']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="majalah">Majalah</a></li>
            <li><a href="{{ route('dashboard', ['genre' => 'teka-teki']) }}" class="nav-link px-3 py-1.5 rounded hover:bg-blue-50 transition" data-content="teka-teki">Teka-Teki</a></li>
            <li><a href="{{ route('artikel.create') }}" class="px-3 py-1.5 rounded bg-blue-600 text-white transition">Tulis Artikel</a></li>
            <li><a href="{{ route('bookmarks') }}" class="nav-link px-3 py-1.5 rounded hover:bg-yellow-100 text-yellow-800 font-bold transition flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#b45309 !important;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" /></svg>Bookmark</a></li>
            <li class="ml-2">
                <div class="relative">
                    <button id="profile-toggle" type="button" class="p-2 rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M6 20c0-2.2 3.6-3.5 6-3.5s6 1.3 6 3.5v1H6v-1z"/></svg>
                    </button>
                    <div id="profile-menu" class="hidden absolute left-1/2 -translate-x-1/2 mt-6 w-48 bg-white rounded-xl shadow-lg border border-blue-100 z-[1050] py-2">
                        <a href="{{ route('settings.profile') }}" class="block px-6 py-3 text-gray-800 hover:bg-blue-50 font-semibold">Pengaturan Akun</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-6 py-3 text-red-600 hover:bg-blue-50 font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
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
    // Profile menu toggle universal
    const profileToggle = document.getElementById('profile-toggle');
    const profileMenu = document.getElementById('profile-menu');
    if (profileToggle && profileMenu) {
        profileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
            if (!profileMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    }
});
</script>
