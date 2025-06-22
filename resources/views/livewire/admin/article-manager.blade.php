<div class="space-y-6 max-w-7xl mx-auto px-2 md:px-6 lg:px-8">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Artikel</h1>
            <p class="mt-2 text-sm text-gray-600">Kelola semua artikel yang ada di website</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.articles.create') }}"
               style="background-color: #7E2320; color: #FFF6BE;"
               class="inline-flex items-center px-5 py-2 border border-transparent rounded-lg shadow-sm text-base font-semibold hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
               onmouseover="this.style.backgroundColor='#6B1F1C'"
               onmouseout="this.style.backgroundColor='#7E2320'">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tulis Artikel Baru
            </a>
        </div>
    </div>

    <!-- Filters -->
    <!-- Filter di-nonaktifkan sesuai permintaan -->

    <!-- Articles Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-2xl border border-gray-200 mt-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Artikel
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Penulis
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Views
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($article->featured_image)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="h-10 w-10 rounded object-cover">
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($article->subheadline, 40) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $article->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $article->category->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($article->status) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $article->view_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $article->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ url()->current() }}" onsubmit="event.preventDefault(); if(confirm('Yakin ingin menghapus artikel ini?')) { this.submit(); }" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 shadow-sm text-xs font-medium rounded text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <h3 class="mt-4 text-sm font-medium text-gray-900">Tidak ada artikel</h3>
                                    <p class="mt-2 text-sm text-gray-500">Mulai dengan menulis artikel pertama Anda.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.articles.create') }}" 
                                           style="background-color: #7E2320; color: #FFF6BE;"
                                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                           onmouseover="this.style.backgroundColor='#6B1F1C'"
                                           onmouseout="this.style.backgroundColor='#7E2320'">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Tulis Artikel Baru
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

    <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full" style="background-color: rgba(126, 35, 32, 0.1);">
                    <svg class="animate-spin h-6 w-6" style="color: #7E2320;" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Memproses...</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Mohon tunggu sebentar</p>
                </div>
            </div>
        </div>
    </div>

    <style>
    input:focus, select:focus {
        border-color: #7E2320 !important;
        box-shadow: 0 0 0 1px #7E2320 !important;
    }

    button:hover {
        transition: all 0.2s ease;
    }

    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #7E2320;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #6B1F1C;
    }
    </style>
</div>