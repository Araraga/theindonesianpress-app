<x-layouts.app :title="__('Bookmark Artikel')">
    <div class="min-h-screen flex flex-col">
        <x-header />
        <!-- Konten utama bookmarks -->
        <div class="flex-1">
            <div class="max-w-5xl mx-auto mt-8">
                <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Artikel yang Disimpan</h1>
                @php
                    $perPage = 6;
                    $page = request()->get('page', 1);
                    $total = $bookmarks->count();
                    $totalPages = ceil($total / $perPage);
                    $currentBookmarks = $bookmarks->forPage($page, $perPage)->values();
                @endphp
                @if($currentBookmarks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($currentBookmarks->chunk(3) as $row)
                        @foreach($row as $bookmark)
                            @php $art = $bookmark->article; @endphp
                            @if($art)
                            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 flex flex-col">
                                <a href="{{ route('artikel.show', $art->id) }}" class="block">
                                    <img src="{{ asset('storage/' . $art->featured_image) }}" alt="Gambar Artikel" class="rounded-t-xl h-40 w-full object-cover">
                                </a>
                                <div class="p-4 flex-1 flex flex-col">
                                    <span class="text-xs text-blue-600 font-semibold mb-2">{{ $art->genre }}</span>
                                    <h2 class="font-bold text-lg text-gray-900 dark:text-white mb-2 line-clamp-2">
                                        {{ Str::limit($art->title, 16, '...') }}
                                    </h2>
                                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                        {{ Str::limit($art->subheadline, 32, '...') }}
                                    </p>
                                    <div class="flex items-center justify-between mt-auto gap-2">
                                        <button type="button" class="text-red-500 hover:underline font-medium" onclick="showDeleteModal({{ $art->id }})">Hapus Bookmark</button>
                                        <form id="delete-bookmark-form-{{ $art->id }}" method="POST" action="{{ route('artikel.unbookmark', $art->id) }}" style="display:none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <!-- PAGINATION -->
                @if($totalPages > 1)
                <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                    @if($page > 1)
                        <a href="?page={{ $page - 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">&laquo; Sebelumnya</a>
                    @endif
                    @for($i = 1; $i <= $totalPages; $i++)
                        <a href="?page={{ $i }}" class="px-4 py-2 rounded font-semibold transition select-none text-black bg-transparent {{ $i == $page ? 'bg-yellow-200 text-yellow-900 font-bold border border-yellow-400' : '' }}" style="border:none; box-shadow:none; opacity:{{ $i == $page ? '1' : '0.5' }};">
                            {{ $i }}
                        </a>
                    @endfor
                    @if($page < $totalPages)
                        <a href="?page={{ $page + 1 }}" class="px-4 py-2 rounded border font-semibold transition bg-blue-900 text-black border-blue-900 hover:bg-blue-800 hover:border-blue-800">Selanjutnya &raquo;</a>
                    @endif
                </div>
                @else
                <div class="flex justify-center mt-10 gap-2 mb-16" style="margin-bottom:2rem !important;">
                    <span class="px-4 py-2 rounded font-semibold select-none text-black bg-transparent border border-yellow-200" style="opacity:1;">1</span>
                </div>
                @endif
                @else
                    <div class="text-gray-500 text-lg">Belum ada artikel yang disimpan.</div>
                @endif
            </div>
        </div>
        {{-- Modal Konfirmasi Hapus Bookmark --}}
        <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-sm w-full text-center">
                <h2 class="text-xl font-bold mb-4 text-red-700">Hapus Bookmark?</h2>
                <p class="mb-6 text-gray-700">Apakah Anda yakin ingin menghapus artikel ini dari bookmark?</p>
                <div class="flex justify-center gap-4">
                    <button onclick="hideDeleteModal()" class="px-4 py-2 rounded font-semibold" style="background:#e5e7eb !important; color:#1f2937 !important; border:none !important;">Batal</button>
                    <button id="modal-delete-btn" class="px-4 py-2 rounded font-bold" style="background:#dc2626 !important; color:#fff !important; border:none !important;">Ya, Hapus</button>
                </div>
            </div>
        </div>
        <script>
            let deleteTargetId = null;
            function showDeleteModal(id) {
                deleteTargetId = id;
                document.getElementById('delete-modal').classList.remove('hidden');
            }
            function hideDeleteModal() {
                deleteTargetId = null;
                document.getElementById('delete-modal').classList.add('hidden');
            }
            document.getElementById('modal-delete-btn').onclick = function() {
                if(deleteTargetId) {
                    document.getElementById('delete-bookmark-form-' + deleteTargetId).submit();
                }
            };
        </script>
        <x-footer />
    </div>
</x-layouts.app>
