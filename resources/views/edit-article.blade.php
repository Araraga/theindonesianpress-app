<x-layouts.app :title="__('Edit Artikel')">
    <div class="min-h-screen flex flex-col" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <x-header />
        <main class="flex-1 flex flex-col items-center justify-center py-10 px-2 md:px-0">
            <div class="w-full max-w-5xl mx-auto rounded-2xl shadow-2xl p-10 md:p-16 mt-8 border-4 border-blue-200 dark:border-blue-700 backdrop-blur-xl" style="background: linear-gradient(180deg, #2A2A2A 0%, #3A4B57 100%);">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-8 text-center tracking-wide font-serif">Edit Artikel</h1>
                <form action="{{ route('artikel.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    <div class="flex flex-col gap-6">
                        <input type="text" name="title" required class="text-4xl md:text-5xl font-extrabold bg-transparent border-none focus:ring-0 focus:outline-none text-gray-900 dark:text-white placeholder:italic placeholder:text-gray-400 mb-2" placeholder="Judul Berita..." value="{{ old('title', $article->title) }}" autofocus>
                        <input type="text" name="subheadline" required class="text-xl md:text-2xl font-semibold bg-transparent border-none focus:ring-0 focus:outline-none text-gray-700 dark:text-gray-300 placeholder:italic placeholder:text-gray-400 mb-4" placeholder="Subheadline (opsional)..." value="{{ old('subheadline', $article->subheadline) }}">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-1 flex flex-col items-center bg-blue-50 dark:bg-neutral-900 rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-blue-700 dark:text-blue-200 mb-3">Genre</label>
                                <select name="genre" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-white dark:bg-neutral-900 text-blue-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold">
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre }}" {{ old('genre', $article->genre) == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 flex flex-col items-center bg-blue-50 dark:bg-neutral-900 rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-blue-700 dark:text-blue-200 mb-3">Gambar Utama (biarkan kosong jika tidak ingin ganti)</label>
                                <input type="file" name="featured_image" accept="image/*" class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-white dark:bg-neutral-900 text-blue-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" />
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="Gambar Saat Ini" class="mt-4 rounded-xl max-h-40">
                            </div>
                        </div>
                        <textarea name="content" rows="22" required class="w-full text-lg md:text-xl bg-transparent border-none focus:ring-0 focus:outline-none text-gray-900 dark:text-white placeholder:italic placeholder:text-gray-400 resize-none min-h-[500px]">{{ old('content', $article->content) }}</textarea>
                    </div>
                    <div class="flex justify-between items-center gap-4 mt-10">
                        <a href="{{ route('artikel.show', $article->id) }}" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-gray-200 dark:bg-neutral-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-neutral-600 transition">
                            Batal
                        </a>
                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <x-footer />
    </div>
    {{-- ...existing script jika ada... --}}
</x-layouts.app>
