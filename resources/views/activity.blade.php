<x-layouts.app :title="__('Komentar & Like')">
    <div class="max-w-3xl mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Aktivitas Komentar & Like</h1>
        <div class="space-y-6">
            <!-- Contoh aktivitas komentar -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col md:flex-row gap-4">
                <div class="flex-shrink-0">
                    <img src="https://source.unsplash.com/80x80/?news,profile" alt="Profil" class="rounded-full h-16 w-16 object-cover">
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-gray-900 dark:text-white">Kamu mengomentari artikel</span>
                        <a href="#" class="text-blue-600 hover:underline font-medium">"Judul Artikel Contoh"</a>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-2">"Komentar kamu di sini, misal: Artikel ini sangat informatif!"</p>
                    <span class="text-xs text-gray-400">2 hari lalu</span>
                </div>
            </div>
            <!-- Contoh aktivitas like -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6 flex flex-col md:flex-row gap-4">
                <div class="flex-shrink-0">
                    <img src="https://source.unsplash.com/80x80/?like,profile" alt="Profil" class="rounded-full h-16 w-16 object-cover">
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-gray-900 dark:text-white">Kamu menyukai artikel</span>
                        <a href="#" class="text-blue-600 hover:underline font-medium">"Berita Terkini"</a>
                    </div>
                    <span class="text-xs text-gray-400">3 hari lalu</span>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
