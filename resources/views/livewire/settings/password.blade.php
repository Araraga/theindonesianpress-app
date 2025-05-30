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
    {{-- Konten utama pengaturan password --}}
    <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <div class="w-full max-w-3xl mx-auto rounded-2xl shadow-2xl border-4 border-blue-200 p-8 md:p-12" style="background:#171717f7 !important; border-color:#1e40af !important;">
            <div class="relative mb-6 w-full">
                <h1 class="font-extrabold text-2xl mb-2" style="color:#FFF6BE !important;">Ubah Password</h1>
                <div class="text-base mb-6" style="color:#fefefe !important;">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman</div>
                <div data-orientation="horizontal" role="none" class="h-px w-full" style="background:#1e40af !important; opacity:0.2 !important;"></div>
            </div>
            <div class="flex-1 self-stretch max-md:pt-6">
                <div class="mt-5 w-full max-w-lg mx-auto">
                    @if (session()->has('password_success'))
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-400 text-green-800 font-semibold text-center" style="color:#166534 !important; background:#bbf7d0 !important; border-color:#22c55e !important;">
                            {{ session('password_success') }}
                        </div>
                    @endif
                    @if (session()->has('password_error'))
                        <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-800 font-semibold text-center" style="color:#b91c1c !important; background:#fee2e2 !important; border-color:#ef4444 !important;">
                            {{ session('password_error') }}
                        </div>
                    @endif
                    <form wire:submit="updatePassword" class="my-6 w-full space-y-8">
                        <div class="flex flex-col gap-6">
                            <div>
                                <label class="block text-lg font-bold mb-2" for="current_password" style="color:#fefefe !important;">Password Lama</label>
                                <input wire:model="current_password" id="current_password" name="current_password" type="password" required autocomplete="current-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="Password Lama" />
                            </div>
                            <div>
                                <label class="block text-lg font-bold mb-2" for="password" style="color:#fefefe !important;">Password Baru</label>
                                <input wire:model="password" id="password" name="password" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="Password Baru" />
                            </div>
                            <div>
                                <label class="block text-lg font-bold mb-2" for="password_confirmation" style="color:#fefefe !important;">Konfirmasi Password</label>
                                <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="Konfirmasi Password" />
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <a href="{{ route('settings.profile') }}" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:transparent !important; color:#fefefe !important; border:2px solid #fefefe !important;">Kembali</a>
                            <button type="submit" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#7E2320 !important; color:#FFF6BE !important;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</div>
</x-layouts.app>
