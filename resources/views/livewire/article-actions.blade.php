<div class="flex items-center gap-6 mt-10 mb-8 px-2 justify-center">
    <button wire:click="like" @if(!$liked) class="flex items-center gap-2 px-6 py-3 cursor-pointer rounded-full font-bold shadow transition bg-green-100 text-green-800 border-2 border-green-400 hover:bg-green-200" @else class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition bg-indigo-600 text-white border-2 border-green-800" @endif {{ $liked ? 'disabled' : '' }}>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-6 0v4H5a2 2 0 00-2 2v7a2 2 0 002 2h14a2 2 0 002-2v-7a2 2 0 00-2-2h-3z" /></svg>
        <span>Like ({{ $likeCount }})</span>
    </button>
    <button wire:click="dislike" @if($liked) class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition bg-red-100 text-red-800 border-2 border-red-400 hover:bg-red-200" @else class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition bg-gray-200 text-gray-500 border-2 border-gray-300 cursor-pointer" @endif {{ !$liked ? 'disabled' : '' }}>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 15v4a3 3 0 006 0v-4h3a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2h3z" /></svg>
        <span>Dislike</span>
    </button>
    @auth
        <button wire:click="toggleBookmark" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold shadow transition @if($bookmarked) bg-yellow-300 text-yellow-900 border-2 border-yellow-500 hover:bg-yellow-400 @else bg-yellow-50 text-yellow-700 border-2 border-yellow-200 hover:bg-yellow-100 @endif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
            </svg>
            <span>{{ $bookmarked ? 'Tersimpan' : 'Bookmark' }}</span>
        </button>
    @endauth
</div>
