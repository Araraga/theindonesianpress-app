<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Kelola Artikel</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola semua artikel yang ada di website</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.articles.create') }}" 
               style="background-color: #7E2320; color: #FFF6BE;"
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
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
    <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Artikel</label>
                <input type="text" wire:model.live="search" 
                       style="border-color: #d1d5db; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-1 sm:text-sm"
                       placeholder="Cari berdasarkan judul atau konten...">
            </div>

            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model.live="statusFilter" 
                        style="border-color: #d1d5db; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-1 sm:text-sm">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="categoryFilter" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select wire:model.live="categoryFilter" 
                        style="border-color: #d1d5db; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-1 sm:text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Urutkan</label>
                <div class="mt-1 flex space-x-2">
                    <select wire:model.live="sortBy" 
                            style="border-color: #d1d5db; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                            class="block w-full rounded-md shadow-sm focus:ring-1 sm:text-sm">
                        <option value="created_at">Tanggal Dibuat</option>
                        <option value="title">Judul</option>
                        <option value="view_count">Views</option>
                        <option value="published_at">Tanggal Publish</option>
                    </select>
                    <button wire:click="sortBy('{{ $sortBy }}')" 
                            style="border-color: #7E2320; color: #7E2320;"
                            class="inline-flex items-center px-3 py-2 border shadow-sm text-sm leading-4 font-medium rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                            onmouseover="this.style.backgroundColor='#f9fafb'"
                            onmouseout="this.style.backgroundColor='white'">
                        <svg class="h-4 w-4 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
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
                                            <img class="h-10 w-10 rounded object-cover" src="{{ $article->featured_image }}" alt="">
                                        </div>
                                    @endif
                                    <div class="{{ $article->featured_image ? 'ml-4' : '' }}">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ Str::limit($article->title, 50) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit(strip_tags($article->excerpt), 60) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="{{ $article->user->profile_picture ?? 'https://ui-avatars.com/api/?name='.urlencode($article->user->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                         alt="">
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $article->user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                      style="background-color: rgba(126, 35, 32, 0.1); color: #7E2320;">
                                    {{ $article->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 
                                       ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($article->view_count) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $article->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <!-- Status Dropdown -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" 
                                                style="border-color: #7E2320; color: #7E2320;"
                                                class="inline-flex items-center px-2 py-1 border shadow-sm text-xs font-medium rounded bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                                onmouseover="this.style.backgroundColor='#f9fafb'"
                                                onmouseout="this.style.backgroundColor='white'">
                                            Status
                                            <svg class="ml-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition
                                             class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                            <div class="py-1">
                                                <button wire:click="changeStatus({{ $article->id }}, 'published')" 
                                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                                    Published
                                                </button>
                                                <button wire:click="changeStatus({{ $article->id }}, 'draft')" 
                                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                                    Draft
                                                </button>
                                                <button wire:click="changeStatus({{ $article->id }}, 'archived')" 
                                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                                    Archived
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" 
                                       style="color: #7E2320;"
                                       class="hover:opacity-70">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <button wire:click="deleteArticle({{ $article->id }})" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')"
                                            class="text-red-600 hover:text-red-900">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
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