<div class="space-y-6">
    <form wire:submit.prevent="submit" class="mb-6">
        <textarea wire:model.defer="body" class="w-full rounded-lg border border-blue-300 p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none text-base resize-none shadow-sm" rows="3" placeholder="Tulis komentar..."></textarea>
        @error('body') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
        <div class="flex justify-end mt-2">
            <button type="submit" class="px-6 py-2 rounded-lg font-bold shadow bg-blue-700 text-white hover:bg-blue-800 transition duration-150 cursor-pointer" wire:loading.attr="disabled">
                <span wire:loading.remove>Kirim</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </div>
    </form>
    <div class="space-y-4">
        @isset($comments)
            @forelse($comments as $comment)
                <div class="flex items-start gap-3 bg-white rounded-lg shadow p-4 border border-blue-100">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center font-bold text-blue-800 text-lg">
                        {{ mb_substr($comment->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-blue-900">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="mt-1 text-gray-800 text-base">{{ $comment->content }}</div>
                    </div>
                    @if(auth()->check() && (int)$comment->user_id === (int)auth()->id())
                        @if($editId === $comment->id)
                            <form wire:submit.prevent="update" class="flex-1 flex flex-col gap-2">
                                <textarea wire:model.defer="editBody" class="w-full rounded border p-2 text-base" rows="2"></textarea>
                                @if($errors->has('editBody')) <div class="text-red-500 text-sm">{{ $errors->first('editBody') }}</div> @endif
                                <div class="flex gap-2 mt-1">
                                    <button type="submit" class="px-3 py-1 rounded bg-blue-700 text-white text-xs font-bold hover:bg-blue-800 focus:ring-2 focus:ring-blue-400">Simpan</button>
                                    <button type="button" wire:click="cancelEdit" class="px-3 py-1 rounded bg-gray-400 text-white text-xs font-bold hover:bg-gray-500 focus:ring-2 focus:ring-gray-300">Batal</button>
                                </div>
                            </form>
                        @else
                            <div class="flex flex-col gap-1 items-end">
                                <button wire:click="startEdit({{ $comment->id }})" class="px-2 py-1 text-xs bg-yellow-400 text-gray-900 rounded font-bold shadow hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 mb-1 cursor-pointer" style="background-color:rgb(238, 255, 0);">Edit</button>
                                
                                <button wire:click="delete({{ $comment->id }})" class="px-2 py-1 text-xs bg-red-600 text-white rounded font-bold shadow hover:bg-red-700 focus:ring-2 focus:ring-red-400 cursor-pointer" style="background-color: #7E2320;">Hapus</button>
                            </div>
                        @endif
                    @endif
                </div>
            @empty
                <div class="text-gray-500 text-center py-8">Belum ada komentar. Jadilah yang pertama!</div>
            @endforelse
        @endisset
    </div>
</div>
