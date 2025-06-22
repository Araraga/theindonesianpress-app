<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            $messages = $e->validator->errors()->all();
            $errorMsg = '';
            foreach ($messages as $msg) {
                if (str_contains($msg, 'current password')) {
                    $errorMsg .= 'Password lama salah. ';
                } elseif (str_contains($msg, 'at least 8 characters')) {
                    $errorMsg .= 'Password baru kurang dari 8 karakter. ';
                } elseif (str_contains($msg, 'must contain at least one uppercase')) {
                    $errorMsg .= 'Password baru harus mengandung huruf besar. ';
                } elseif (str_contains($msg, 'must contain at least one lowercase')) {
                    $errorMsg .= 'Password baru harus mengandung huruf kecil. ';
                } elseif (str_contains($msg, 'must contain at least one number')) {
                    $errorMsg .= 'Password baru harus mengandung angka. ';
                } elseif (str_contains($msg, 'must contain at least one symbol')) {
                    $errorMsg .= 'Password baru harus mengandung simbol. ';
                } elseif (str_contains($msg, 'confirmation')) {
                    $errorMsg .= 'Konfirmasi password tidak sama. ';
                } else {
                    $errorMsg .= $msg . ' ';
                }
            }
            session()->flash('password_error', trim($errorMsg));
            throw $e;
        }

        try {
            Auth::user()->update([
                'password' => Hash::make($validated['password']),
            ]);
            $this->reset('current_password', 'password', 'password_confirmation');
            session()->flash('password_success', 'Password berhasil diperbarui.');
            $this->dispatch('password-updated');
        } catch (\Exception $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            session()->flash('password_error', 'Terjadi kesalahan saat memperbarui password.');
        }
    }
}; ?>

<x-layouts.app title="Pengaturan Password">
    <div class="min-h-screen flex flex-col">
        <x-header />
        <main class="flex-1 container mx-auto flex flex-col items-center justify-center py-10 px-2 md:px-0 min-h-[60vh]" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
            <div class="w-full max-w-lg mx-auto rounded-2xl shadow-2xl border-4 border-blue-200 p-8 md:p-12" style="background:#171717f7 !important; border-color:#1e40af !important;">
                <h1 class="font-extrabold text-2xl mb-6" style="color:#FFF6BE !important;">Pengaturan Password</h1>
                <div class="text-base mb-6" style="color:#fefefe !important;">Ganti password akun Anda di sini.</div>

                {{-- Navigasi --}}
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-8">
                    <a href="/settings/profile" class="h-10 flex items-center gap-3 rounded-lg px-6 font-bold bg-blue-50 hover:bg-blue-100 transition text-[#171717] border-2 border-blue-200 shadow" style="min-width:160px; text-align:center;">Profile</a>
                    <a href="{{ route('settings.password') }}" class="h-10 flex items-center gap-3 rounded-lg px-6 font-bold bg-blue-50 hover:bg-blue-100 transition text-[#171717] border-2 border-blue-200 shadow" style="min-width:160px; text-align:center;">Password</a>
                </div>

                {{-- Tampilkan pesan error/sukses --}}
                @if (session('error'))
                    <div class="mb-4 p-4 rounded bg-red-600 text-white font-bold">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4 p-4 rounded bg-green-600 text-white font-bold">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Form ganti password --}}
                <form method="POST" action="{{ route('settings.password.update') }}" class="w-full max-w-md mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-lg font-bold mb-2" for="current_password" style="color:#fefefe !important;">Password Lama</label>
                        <input id="current_password" name="current_password" type="password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold text-lg" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important;">
                        @error('current_password')
                            <div class="text-red-400 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-lg font-bold mb-2" for="new_password" style="color:#fefefe !important;">Password Baru</label>
                        <input id="new_password" name="new_password" type="password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold text-lg" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important;">
                        @error('new_password')
                            <div class="text-red-400 mt-1 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-8">
                        <label class="block text-lg font-bold mb-2" for="new_password_confirmation" style="color:#fefefe !important;">Konfirmasi Password Baru</label>
                        <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold text-lg" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important;">
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="#" onclick="window.history.length > 1 ? window.history.back() : window.location='{{ route('dashboard') }}'; return false;" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:transparent !important; color:#fefefe !important; border:2px solid #444 !important;">Kembali</a>
                        <button type="submit" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#7E2320 !important; color:#FFF6BE !important;">Simpan Password</button>
                    </div>
                </form>
            </div>
        </main>
        <x-footer />
    </div>
</x-layouts.app>
