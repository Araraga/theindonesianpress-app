<x-layouts.app :title="__('Tulis Artikel')">
    <div class="min-h-screen flex flex-col" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <x-header />
        <main class="flex-1 flex flex-col items-center justify-center py-10 px-2 md:px-0">
            <div class="w-full max-w-5xl mx-auto rounded-2xl shadow-2xl p-10 md:p-16 mt-8 border-4 border-blue-200 dark:border-blue-700 backdrop-blur-xl" style="background: #171717f7;">
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#FFF6BE] !text-[#FFF6BE] mb-8 text-center tracking-wide font-serif" style="color:#FFF6BE !important;">Tulis Artikel Baru</h1>
                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    <div class="flex flex-col gap-6">
                        <input type="text" name="title" required class="text-xl md:text-x2 font-extrabold bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] mb-2" placeholder="Judul Berita..." value="{{ old('title') }}" autofocus>
                        <input type="text" name="subheadline" required class="text-xl md:text-2xl font-normal bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] mb-4" placeholder="Subheadline (opsional)..." value="{{ old('subheadline') }}">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-1 flex flex-col items-center bg-transparent rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-[#FFF6BE] !text-[#FFF6BE] mb-3" style="color:#FFF6BE !important;">Kategori</label>
                                <select name="category_id" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-[#232323] text-[#fefefe] focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" style="color:#fefefe;">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" style="color:#111 !important; background:#fff;" {{ old('category_id') == $category->id ? 'selected style=color:#fefefe!important;background:#232323;' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 flex flex-col items-center bg-transparent rounded-2xl border-2 border-blue-200 dark:border-blue-700 p-6 shadow-md">
                                <label class="block text-lg font-bold text-[#FFF6BE] !text-[#FFF6BE] mb-3" style="color:#FFF6BE !important;">Gambar Utama</label>
                                <input type="file" name="featured_image" accept="image/*" required class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 dark:border-blue-700 bg-[#232323] text-[#fefefe] focus:ring-2 focus:ring-blue-500 outline-none text-lg font-semibold" />
                            </div>
                        </div>
                        <textarea name="content" rows="22" required class="w-full text-lg md:text-xl bg-transparent border-none focus:ring-0 focus:outline-none text-[#fefefe] placeholder:italic placeholder:text-[#cccccc] resize-none min-h-[500px]" placeholder="Tulis narasi berita, opini, atau laporan Anda di sini. Mulailah dengan paragraf pembuka yang menarik, lalu lanjutkan dengan isi berita secara natural...">{{ old('content') }}</textarea>
                    </div>
                    <div class="flex justify-between items-center gap-4 mt-10">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-[#232323] text-[#fefefe] font-semibold hover:bg-[#333] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Kembali
                        </a>
                        <div class="flex gap-4">
                            <button type="reset" class="px-6 py-2 rounded-lg bg-[#232323] text-[#fefefe] font-semibold hover:bg-[#333] transition">Reset</button>
                            <button type="submit" class="px-6 py-2 rounded-lg" style="background:#7E2320; color:#FFF6BE; font-weight:600;">Terbitkan Artikel</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <x-footer />
    </div>
</x-layouts.app>
