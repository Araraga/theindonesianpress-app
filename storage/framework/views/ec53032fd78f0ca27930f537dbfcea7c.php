<div class="w-full" style="background:#171717 !important;">
    <div class="container mx-auto flex flex-row items-center py-8 px-1 gap-1 relative">
        <img src="<?php echo e(asset('images/header-banner.png')); ?>" alt="The Indonesian Press Header" class="w-auto max-w-5xl" style="height:auto;max-height:100px;object-fit:contain;margin-left:0 !important;" />
        <div class="flex-1"></div>
        <div class="flex items-center gap-3 pr-2" style="padding-right:16px !important;">
            <form id="search-form" class="relative" action="<?php echo e(route('search.results')); ?>" method="get" autocomplete="off">
                <input name="q" id="search-input" type="text" placeholder="Cari berita..." class="w-64 px-4 py-2 rounded-lg border border-neutral-300 bg-gray-50 text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none text-base" autocomplete="off" value="<?php echo e(request('q')); ?>" />
                <ul id="search-autocomplete-results" class="absolute left-0 mt-1 w-full bg-white border border-blue-200 rounded-lg shadow-lg z-50 hidden"></ul>
            </form>
        </div>
    </div>
</div>
<nav class="w-full sticky top-0 z-[9999]" style="background:#171717; color:#FEFEFE; position:sticky; z-index:9999;">
    <div class="w-full max-w-[900px] mx-auto flex flex-wrap justify-center py-3 px-4 gap-2 md:gap-4 z-0 relative">
        <ul class="flex flex-wrap justify-center gap-2 md:gap-4 text-sm font-semibold items-center" style="color:#FEFEFE !important;">
            <li><a href="<?php echo e(route('dashboard')); ?>" class="nav-link px-3 py-1.5 rounded transition" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Beranda</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'bisnis'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="bisnis" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Bisnis & Tenaga Kerja</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'opini'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="opini" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Opini</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'seni'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="seni" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Seni & Budaya</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'sains'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="sains" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Sains</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'olahraga'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="olahraga" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Olahraga</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'foto'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="foto" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Foto</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'ilustrasi'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="ilustrasi" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Ilustrasi</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'video'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="video" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Video</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'majalah'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="majalah" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Majalah</a></li>
            <li><a href="<?php echo e(route('dashboard', ['genre' => 'teka-teki'])); ?>" class="nav-link px-3 py-1.5 rounded transition" data-content="teka-teki" style="color:#FEFEFE !important;" onmouseover="this.style.background='#FEFEFE';this.style.color='#171717';" onmouseout="this.style.background='';this.style.color='#FEFEFE';">Teka-Teki</a></li>
            <li><a href="<?php echo e(route('artikel.create')); ?>" class="px-3 py-1.5 rounded transition flex items-center gap-2" style="background:#7E2320 !important; color:#FEFEFE !important;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#FEFEFE !important;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z" /></svg>
                Tulis Artikel
            </a></li>
            <li><a href="<?php echo e(route('bookmarks')); ?>" class="px-3 py-1.5 rounded font-bold transition flex items-center gap-2" style="background:#FFF6BE !important; color:#7E2320 !important;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#7E2320 !important;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" /></svg>
                Bookmark
            </a></li>
            <li class="ml-2 relative">
                <button id="profile-toggle" type="button" class="p-2 rounded-full hover:bg-white focus:outline-none focus:ring-2 focus:ring-white transition flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#FEFEFE]" fill="none" stroke="#FEFEFE" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M6 20c0-2.2 3.6-3.5 6-3.5s6 1.3 6 3.5v1H6v-1z"/>
                    </svg>
                </button>
                <div id="profile-menu"
                     class="hidden absolute mt-6 w-48 bg-white rounded-xl shadow-lg border border-blue-100 z-[1050] py-2"
                     style="top:100% !important; right:-40px !important;">
                    <a href="<?php echo e(route('settings.profile')); ?>"
                       class="block px-6 py-3 text-gray-800 hover:bg-blue-50 font-semibold">Pengaturan Akun</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="w-full text-left px-6 py-3 text-red-600 hover:bg-blue-50 font-semibold">Logout
                        </button>
                    </form>
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
                .then((data) => {
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
        // Toggle saat klik ikon profil
        profileToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        // Tutup saat klik di luar
        document.addEventListener('click', function (e) {
            if (!profileMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });

        // Tutup saat tekan ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                profileMenu.classList.add('hidden');
            }
        });
    } else {
        console.error('Profile toggle/menu element not found!');
    }
});
</script>
<?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views/components/header.blade.php ENDPATH**/ ?>