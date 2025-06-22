<x-layouts.app :title="__('Detail Artikel')">
    <div class="max-w-3xl mx-auto mt-8">
        <article class="bg-white dark:bg-neutral-800 rounded-xl shadow p-8 border border-neutral-200 dark:border-neutral-700">
            <div class="mb-4 flex items-center gap-4">
                <img src="https://source.unsplash.com/48x48/?profile,author" alt="Penulis" class="rounded-full h-12 w-12 object-cover">
                <div>
                    <div class="font-semibold text-gray-900 dark:text-white">Nama Penulis</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Dipublikasikan 27 Mei 2025</div>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Judul Artikel Contoh</h1>
            <span class="inline-block bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 text-xs font-semibold px-3 py-1 rounded mb-4">Opini</span>
            <img src="https://source.unsplash.com/800x400/?news,headline" alt="Gambar Artikel" class="rounded-xl w-full h-64 object-cover mb-6">
            <div class="prose dark:prose-invert max-w-none mb-6">
                <p>Ini adalah isi lengkap dari artikel. Konten ini hanya contoh untuk menampilkan tampilan detail artikel pada dashboard user. Artikel ini membahas berbagai topik menarik seputar dunia pers dan media di Indonesia.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod, urna eu tincidunt consectetur, nisi nisl aliquam enim, eget facilisis quam felis id mauris.</p>
            </div>
            <div class="flex items-center gap-6 mb-6">
                <button class="flex items-center gap-2 text-blue-600 hover:underline font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Like (120)
                </button>
                <button class="flex items-center gap-2 text-yellow-500 hover:underline font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z"/></svg>
                    Bookmark
                </button>
            </div>
            <section class="mt-8">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Komentar</h2>
                <form class="mb-6">
                    <textarea rows="3" class="w-full px-4 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 bg-gray-50 dark:bg-neutral-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none mb-2" placeholder="Tulis komentar..."></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Kirim Komentar</button>
                    </div>
                </form>
                <!-- Daftar Komentar -->
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <img src="https://source.unsplash.com/32x32/?profile,commenter" alt="User" class="rounded-full h-8 w-8 object-cover">
                        <div>
                            <div class="font-semibold text-gray-900 dark:text-white">User A</div>
                            <div class="text-gray-600 dark:text-gray-300">Artikel ini sangat bermanfaat, terima kasih!</div>
                            <div class="text-xs text-gray-400">1 jam lalu</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <img src="https://source.unsplash.com/32x32/?profile,commenter2" alt="User" class="rounded-full h-8 w-8 object-cover">
                        <div>
                            <div class="font-semibold text-gray-900 dark:text-white">User B</div>
                            <div class="text-gray-600 dark:text-gray-300">Tulisan yang menarik dan informatif!</div>
                            <div class="text-xs text-gray-400">2 jam lalu</div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </div>
</x-layouts.app>
