import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        if (typeof Livewire !== 'undefined') {
            console.log('Livewire detected, starting Alpine after Livewire init');
            document.addEventListener('livewire:init', () => {
                Alpine.start();
                console.log('Alpine started after Livewire init');
            });
        } else {
            console.log('No Livewire detected, starting Alpine normally');
            Alpine.start();
        }
    }, 100);
});

// Tambahkan fungsi submitComment jika dibutuhkan oleh fitur User
window.submitComment = function(form) {
    const btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    const textarea = form.querySelector('textarea[name=content]');
    const content = textarea.value;
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ content })
    })
    .then(res => res.json())
    .then(data => {
        if (data.comment) {
            // Tambahkan komentar baru ke #comments-list
            const list = document.getElementById('comments-list');
            const div = document.createElement('div');
            div.className = 'bg-white rounded-lg border p-4 mt-2';
            div.innerHTML = `<div class="flex items-center gap-2 mb-1">
                <span class="font-bold" style="color:#1e40af !important;">${data.comment.user_name}</span>
                <span class="text-xs" style="color:#64748b !important;">Baru saja</span>
            </div>
            <div class="text-gray-800" style="color:#1e293b !important;">${data.comment.content}</div>`;
            list.prepend(div);
            textarea.value = '';
        }
        btn.disabled = false;
    })
    .catch(() => { btn.disabled = false; });
}
