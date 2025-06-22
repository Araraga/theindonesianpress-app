@props(['comment'])
<div class="bg-white rounded-lg border p-4" style="border-color:#1e40af !important;" id="comment-{{ $comment->id }}">
    <div class="flex items-center gap-2 mb-1">
        <span class="font-bold" style="color:#1e40af !important;">{{ $comment->user->name ?? 'Anonim' }}</span>
        <span class="text-xs" style="color:#64748b !important;">{{ $comment->created_at->diffForHumans() }}</span>
        @if(auth()->check() && $comment->user_id === auth()->id())
            <button onclick="editComment({{ $comment->id }}, '{{ addslashes($comment->content) }}')" class="ml-2 px-2 py-1 rounded text-xs font-bold bg-yellow-100 hover:bg-yellow-200 text-yellow-800 transition">Edit</button>
        @endif
    </div>
    <div class="text-gray-800" style="color:#1e293b !important;" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</div>
</div>
