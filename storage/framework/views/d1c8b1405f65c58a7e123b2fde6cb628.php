<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

?>

<section class="w-full min-h-screen flex flex-col items-center justify-center" style="background:linear-gradient(135deg,#e0e7ff 0%,#f0f6ff 100%) !important;">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl border-4 border-blue-200 p-8 md:p-12" style="background:#fff !important; border-color:#1e40af !important;">
        <div class="relative mb-6 w-full">
            <h1 class="font-extrabold text-2xl mb-2" style="color:#1e40af !important;">Update Password</h1>
            <div class="text-base mb-6" style="color:#2563eb !important;">Ensure your account is using a long, random password to stay secure</div>
            <div data-orientation="horizontal" role="none" class="h-px w-full" style="background:#1e40af !important; opacity:0.2 !important;"></div>
        </div>
        <div class="flex-1 self-stretch max-md:pt-6">
            <div class="mt-5 w-full max-w-lg mx-auto">
                <!--[if BLOCK]><![endif]--><?php if(session()->has('password_success')): ?>
                    <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-400 text-green-800 font-semibold text-center" style="color:#166534 !important; background:#bbf7d0 !important; border-color:#22c55e !important;">
                        <?php echo e(session('password_success')); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php if(session()->has('password_error')): ?>
                    <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-800 font-semibold text-center" style="color:#b91c1c !important; background:#fee2e2 !important; border-color:#ef4444 !important;">
                        <?php echo e(session('password_error')); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <form wire:submit="updatePassword" class="my-6 w-full space-y-8">
                    <div class="flex flex-col gap-6">
                        <div>
                            <label class="block text-lg font-bold mb-2" for="current_password" style="color:#1e40af !important;">Current Password</label>
                            <input wire:model="current_password" id="current_password" name="current_password" type="password" required autocomplete="current-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-blue-400 transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;" placeholder="Current Password" />
                        </div>
                        <div>
                            <label class="block text-lg font-bold mb-2" for="password" style="color:#1e40af !important;">New Password</label>
                            <input wire:model="password" id="password" name="password" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-blue-400 transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;" placeholder="New Password" />
                        </div>
                        <div>
                            <label class="block text-lg font-bold mb-2" for="password_confirmation" style="color:#1e40af !important;">Confirm Password</label>
                            <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-blue-400 transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <div class="flex justify-between mt-8">
                        <a href="<?php echo e(route('settings.profile')); ?>" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#e0e7ff !important; color:#1e40af !important; border:2px solid #1e40af !important;">Kembali</a>
                        <button type="submit" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#1e40af !important; color:#fff !important;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views\livewire/settings/password.blade.php ENDPATH**/ ?>