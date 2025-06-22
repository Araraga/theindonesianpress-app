@extends('admin.layout')

@section('title', 'Tulis Artikel Baru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100">
    <!-- Modern Header dengan Glass Effect -->
    <div class="backdrop-blur-sm bg-white/80 border-b border-gray-200/50 sticky top-16 z-30">
        <div class="px-4 sm:px-6 lg:px-8 py-6">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-red-900 to-red-700 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-black" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent px-2">
                            Tulis Artikel Baru
                        </h1>
                        <p class="mt-1 text-sm text-gray-600 px-2">Bagikan cerita dan wawasan Anda kepada dunia</p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.articles.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 hover:shadow-md"
                       style="focus:ring-color: #7E2320;">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="max-w-7xl mx-auto">
            @csrf
            
            <div class="grid grid-cols-1 xl:grid-cols-12 lg:grid-cols-8 gap-6">
                <!-- Main Editor Area -->
                <div class="xl:col-span-8 lg:col-span-5 space-y-6">
                    <!-- Title Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 p-6 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-amber-400 to-orange-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.5c0 4.478 3.313 8.168 7.5 8.5a9.536 9.536 0 001.5-.126m0 0A9.536 9.536 0 009 21c0-1.052-.164-2.062-.476-3.008m.476 3.008c0-1.052.164-2.062.476-3.008m0 0c.652-.613 1.548-1.069 2.5-1.5m0 0V14.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1.5m-1.5-1.5H9m1.5 0h1.5m0 0V9m0 5.5v-5.5m0 5.5h2.5a.5.5 0 01.5.5v1.5a.5.5 0 01-.5.5h-2.5zm0-5.5V9h2.5a.5.5 0 01.5.5v4m-2.5 0V9" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Judul Artikel</h3>
                        </div>
                        <input type="text" id="title" name="title" required
                               value="{{ old('title') }}"
                               style="border-color: #e5e7eb; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                               class="block w-full text-2xl font-bold rounded-xl border-2 shadow-sm focus:ring-2 focus:ring-opacity-20 sm:text-xl transition-all duration-200 placeholder-gray-400 py-4 px-6 @error('title') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel yang menarik...">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Subheadline Card (dulu Excerpt) -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 p-6 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-400 to-indigo-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 17.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Subheadline</h3>
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-md">Opsional</span>
                        </div>
                        <textarea id="subheadline" name="subheadline" rows="3"
                                  style="border-color: #e5e7eb; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                                  class="block w-full rounded-xl border-2 shadow-sm focus:ring-2 focus:ring-opacity-20 sm:text-sm transition-all duration-200 placeholder-gray-400 py-3 px-4 @error('subheadline') border-red-500 @enderror"
                                  placeholder="Tulis subheadline singkat untuk artikel Anda...">{{ old('subheadline') }}</textarea>
                        @error('subheadline')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Content Editor Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 p-6 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 18H3v-4.875c0-.621.504-1.125 1.125-1.125h4.125c.621 0 1.125.504 1.125 1.125V18" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Konten Artikel</h3>
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-md">Wajib</span>
                        </div>
                        <div class="prose-editor-container">
                            <textarea id="content" name="content" rows="20" required
                                      style="border-color: #e5e7eb; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                                      class="block w-full rounded-xl border-2 shadow-sm focus:ring-2 focus:ring-opacity-20 sm:text-sm transition-all py-4 px-6 duration-200 @error('content') border-red-500 @enderror"
                                      placeholder="Mulai menulis artikel Anda di sini...">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-4 lg:col-span-3 space-y-4">
                    <!-- Featured Image Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200/60 p-4 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-indigo-400 to-purple-500 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900">Gambar</h3>
                        </div>
                        <div class="relative">
                            <input type="file" id="featured_image" name="featured_image" accept="image/*"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 @error('featured_image') border-red-500 @enderror">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors duration-200">
                                <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-2">
                                    <span class="block text-sm font-medium text-gray-900">Upload</span>
                                    <span class="block text-xs text-gray-500">drag & drop</span>
                                </div>
                            </div>
                        </div>
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG. Max 5MB</p>
                    </div>

                    <!-- Category Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200/60 p-4 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-r from-red-400 to-pink-500 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900">Kategori</h3>
                            <span class="px-1.5 py-0.5 text-xs font-medium bg-red-100 text-red-600 rounded-md">Wajib</span>
                        </div>
                        <select id="category_id" name="category_id" required
                                style="border-color: #e5e7eb; focus:border-color: #7E2320; focus:ring-color: #7E2320;"
                                class="block w-full rounded-lg border-2 shadow-sm focus:ring-2 focus:ring-opacity-20 text-sm transition-all px-4 py-2 duration-200 @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sticky Action Bar -->
            <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm border-t border-gray-200/50 mt-8 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-4">
                <div class="max-w-7xl mx-auto flex items-center justify-end">
                    <button type="submit" name="action" value="publish"
                            style="background-color: #7E2320; color: #FFF6BE; focus:ring-color: #7E2320;"
                            class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5"
                            onmouseover="this.style.backgroundColor='#6B1F1C'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.backgroundColor='#7E2320'; this.style.transform='translateY(0)';">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        Publikasikan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

<!-- Styles -->
<style>
.has-\[\:checked\]\:border-yellow-400:has(:checked) {
    border-color: #facc15 !important;
    background-color: #fefce8 !important;
}

.has-\[\:checked\]\:bg-yellow-50:has(:checked) {
    background-color: #fefce8 !important;
}

.has-\[\:checked\]\:border-green-400:has(:checked) {
    border-color: #4ade80 !important;
    background-color: #f0fdf4 !important;
}

.has-\[\:checked\]\:bg-green-50:has(:checked) {
    background-color: #f0fdf4 !important;
}

.ck-editor__editable {
    min-height: 400px;
    border-radius: 12px !important;
    border: 2px solid #e5e7eb !important;
    transition: all 0.2s ease !important;
}

.ck-editor__editable:focus {
    border-color: #7E2320 !important;
    box-shadow: 0 0 0 3px rgba(126, 35, 32, 0.1) !important;
}

.ck-toolbar {
    border-radius: 12px 12px 0 0 !important;
    border: 2px solid #e5e7eb !important;
    border-bottom: none !important;
}

/* File upload hover effect */
.file-upload-area:hover .upload-icon {
    transform: scale(1.1);
    color: #7E2320;
}

* {
    transition: all 0.2s ease;
}

/* Glass effect for cards */
.glass-effect {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
}

/* Progress indicator */
.progress-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #d1d5db;
    transition: all 0.3s ease;
}

.progress-dot.active {
    background: #7E2320;
    transform: scale(1.3);
}

/* Auto-save */
@keyframes pulse-save {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.auto-save-indicator {
    animation: pulse-save 2s infinite;
}

/* Responsive */
@media (max-width: 768px) {
    .prose-editor-container {
        font-size: 16px;
    }
    
    .sticky-bottom-bar {
        padding-bottom: env(safe-area-inset-bottom);
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .glass-effect {
        background: rgba(17, 24, 39, 0.9);
    }
}

button:focus, 
input:focus, 
select:focus, 
textarea:focus {
    outline: 2px solid #7E2320;
    outline-offset: 2px;
}

/* scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #7E2320;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #6B1F1C;
}

/* Floating action button untuk mobile */
@media (max-width: 640px) {
    .floating-save-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 50;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        box-shadow: 0 4px 12px rgba(126, 35, 32, 0.3);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'blockQuote', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'insertTable', 'horizontalLine', '|',
                    'undo', 'redo', '|',
                    'findAndReplace', 'wordCount'
                ],
                shouldNotGroupWhenFull: true
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            placeholder: 'Mulai menulis artikel Anda di sini... \n\nTips: \n• Gunakan heading untuk struktur yang jelas\n• Tambahkan gambar untuk memperkaya konten\n• Buat paragraf yang mudah dibaca',
            wordCount: {
                onUpdate: stats => {
                    console.log(`Words: ${stats.words}, Characters: ${stats.characters}`);
                }
            }
        })
        .then(editor => {
            window.editor = editor;
            
            // Auto-save 
            let autoSaveTimer;
            editor.model.document.on('change:data', () => {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    console.log('Auto-saving...');
                }, 3000);
                
                // Update word count
                updateWordCount();
            });
            
            // Initial word count
            updateWordCount();
        })
        .catch(error => {
            console.error('CKEditor initialization failed:', error);
        });

    // File upload preview
    const fileInput = document.getElementById('featured_image');
    const uploadArea = fileInput.parentElement;
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Jangan hapus input file, cukup tampilkan preview di bawahnya
                let preview = uploadArea.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'image-preview mt-2';
                    uploadArea.appendChild(preview);
                }
                preview.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg mb-2">
                    <p class="text-sm font-medium text-gray-900">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.classList.add('border-blue-400', 'bg-blue-50');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    }

    // Title auto-slug generation 
    const titleInput = document.getElementById('title');
    titleInput.addEventListener('input', function() {
        console.log('Title changed:', this.value);
    });

    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Sync CKEditor data ke textarea sebelum validasi
        if (window.editor) {
            document.getElementById('content').value = window.editor.getData();
        }

        const requiredFields = ['title', 'content', 'category_id'];
        let hasErrors = false;

        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (!field.value.trim()) {
                hasErrors = true;
                field.classList.add('border-red-500');
                
                // Show error message
                let errorMsg = field.parentElement.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('p');
                    errorMsg.className = 'error-message mt-2 text-sm text-red-600 flex items-center';
                    errorMsg.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Field ini wajib diisi
                    `;
                    field.parentElement.appendChild(errorMsg);
                }
            } else {
                field.classList.remove('border-red-500');
                const errorMsg = field.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });

        if (hasErrors) {
            e.preventDefault();
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save as draft
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            document.querySelector('button[value="draft"]').click();
        }
        
        // Ctrl/Cmd + Enter to publish
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('button[value="publish"]').click();
        }
    });

    function updateProgress() {
        const title = document.getElementById('title').value;
        const content = window.editor?.getData() || '';
        const category = document.getElementById('category_id').value;
        
        let progress = 0;
        if (title.trim()) progress += 33;
        if (content.trim()) progress += 33;
        if (category) progress += 34;
        
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            progressBar.style.width = progress + '%';
        }
    }

    function updateWordCount() {
        const content = window.editor?.getData() || '';
        const plainText = content.replace(/<[^>]*>/g, '');
        const words = plainText.trim() ? plainText.trim().split(/\s+/).length : 0;
        const characters = plainText.length;
        const readingTime = Math.max(1, Math.ceil(words / 200));
        
        const wordCountEl = document.getElementById('word-count');
        const charCountEl = document.getElementById('char-count');
        const readTimeEl = document.getElementById('read-time');
        
        if (wordCountEl) wordCountEl.textContent = words.toLocaleString();
        if (charCountEl) charCountEl.textContent = characters.toLocaleString();
        if (readTimeEl) readTimeEl.textContent = `${readingTime} min`;
    }

    ['title', 'category_id'].forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) {
            field.addEventListener('input', updateProgress);
            field.addEventListener('input', updateWordCount);
        }
    });
    
    const titleInput = document.getElementById('title');
    if (titleInput) {
        titleInput.addEventListener('input', updateWordCount);
    }
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(console.error);
}
</script>
@endsection