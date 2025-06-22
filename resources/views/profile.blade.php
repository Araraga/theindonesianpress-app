<x-layouts.app :title="__('Profil Saya')">
    <div class="max-w-xl mx-auto bg-white dark:bg-neutral-800 rounded-xl shadow p-8 mt-8 border border-neutral-200 dark:border-neutral-700">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Profil Saya</h1>
        <form>
            <div class="flex flex-col items-center mb-6">
                <img src="https://source.unsplash.com/120x120/?profile,avatar" alt="Foto Profil" class="rounded-full h-24 w-24 object-cover mb-2">
                <button type="button" class="text-blue-600 hover:underline text-sm">Ganti Foto</button>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" class="w-full px-4 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 bg-gray-50 dark:bg-neutral-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" value="Nama User">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Email</label>
                <input type="email" class="w-full px-4 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 bg-gray-50 dark:bg-neutral-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" value="user@email.com">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Bio Singkat</label>
                <textarea rows="3" class="w-full px-4 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 bg-gray-50 dark:bg-neutral-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">Saya adalah penulis di The Indonesian Press.</textarea>
            </div>
            <div class="flex justify-end gap-4">
                <button type="reset" class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-neutral-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-neutral-600 transition">Reset</button>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layouts.app>
