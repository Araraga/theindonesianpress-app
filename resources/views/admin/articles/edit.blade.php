@extends('admin.layout')

@section('title', 'Edit Artikel')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Artikel</h1>
            <p class="mt-2 text-sm text-gray-700">Edit artikel yang sudah ada</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.articles.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        @php
            // For demo purposes, create a sample article object
            $article = (object) [
                'id' => $article ?? 1,
                'title' => 'Sample Article Title',
                'excerpt' => 'Sample excerpt text...',
                'content' => 'Sample article content...',
                'status' => 'draft',
                'category_id' => 1,
                'featured_image' => null,
                'tags' => collect([])
            ];
        @endphp
        
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Artikel *</label>
                        <input type="text" id="title" name="title" required
                               value="{{ old('title', $article->title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('title') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
                        <textarea id="excerpt" name="excerpt" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('excerpt') border-red-500 @enderror"
                                  placeholder="Ringkasan singkat artikel (opsional)">{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Konten Artikel *</label>
                        <textarea id="content" name="content" rows="20" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('content') border-red-500 @enderror"
                                  placeholder="Tulis konten artikel di sini...">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Article Info -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-900 mb-2">Info Artikel</h3>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p><strong>Status:</strong> 
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 
                                       ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </p>
                            <p><strong>ID:</strong> #{{ $article->id }}</p>
                            @if($article->status === 'published')
                                <p><strong>Published:</strong> {{ now()->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Status Publikasi</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="draft" name="status" type="radio" value="draft" 
                                       {{ old('status', $article->status) == 'draft' ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <label for="draft" class="ml-3 block text-sm font-medium text-gray-700">
                                    Draft
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="published" name="status" type="radio" value="published"
                                       {{ old('status', $article->status) == 'published' ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <label for="published" class="ml-3 block text-sm font-medium text-gray-700">
                                    Published
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="archived" name="status" type="radio" value="archived"
                                       {{ old('status', $article->status) == 'archived' ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <label for="archived" class="ml-3 block text-sm font-medium text-gray-700">
                                    Archived
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">Kategori *</label>
                        <select id="category_id" name="category_id" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="featured_image" class="block text-sm font-medium text-gray-900 mb-2">Gambar Unggulan</label>
                        
                        @if($article->featured_image)
                            <div class="mb-3">
                                <img src="{{ $article->featured_image }}" alt="Current featured image" class="w-full h-32 object-cover rounded-md">
                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                            </div>
                        @endif
                        
                        <input type="file" id="featured_image" name="featured_image" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('featured_image') border-red-500 @enderror">
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 5MB. Kosongkan jika tidak ingin mengubah.</p>
                    </div>

                    <!-- Tags -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="tags" class="block text-sm font-medium text-gray-900 mb-2">Tags</label>
                        <input type="text" id="tags" name="tags" 
                               value="{{ old('tags', $article->tags->pluck('name')->implode(', ')) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               placeholder="teknologi, politik, ekonomi">
                        <p class="mt-1 text-xs text-gray-500">Pisahkan dengan koma</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div>
                    <button type="button" onclick="deleteArticle()" 
                            class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Hapus Artikel
                    </button>
                </div>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.articles.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75a.75.75 0 01.75-.75h7.5a.75.75 0 01.75.75z" />
                        </svg>
                        Update Artikel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Rich Text Editor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    function deleteArticle() {
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.')) {
            // Create a form to delete the article
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.articles.destroy", $article->id) }}';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection